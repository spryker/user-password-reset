<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\UserPasswordReset\Persistence;

use Generated\Shared\Transfer\ResetPasswordTransfer;
use Orm\Zed\UserPasswordReset\Persistence\Map\SpyResetPasswordTableMap;
use Orm\Zed\UserPasswordReset\Persistence\SpyResetPassword;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Spryker\Zed\UserPasswordReset\Persistence\UserPasswordResetPersistenceFactory getFactory()
 */
class UserPasswordResetEntityManager extends AbstractEntityManager implements UserPasswordResetEntityManagerInterface
{
    public function createResetPassword(ResetPasswordTransfer $resetPasswordTransfer): ResetPasswordTransfer
    {
        return $this->saveResetPassword($resetPasswordTransfer, new SpyResetPassword());
    }

    public function updateResetPassword(ResetPasswordTransfer $resetPasswordTransfer): ResetPasswordTransfer
    {
        /** @var \Orm\Zed\UserPasswordReset\Persistence\SpyResetPassword $resetPasswordEntity */
        $resetPasswordEntity = $this->getFactory()
            ->createPropelResetPasswordQuery()
            ->filterByIdAuthResetPassword($resetPasswordTransfer->getIdResetPassword())
            ->findOne();

        return $this->saveResetPassword($resetPasswordTransfer, $resetPasswordEntity);
    }

    public function invalidatePreviousPasswordResets(ResetPasswordTransfer $resetPasswordTransfer): ResetPasswordTransfer
    {
        $statusField = SpyResetPasswordTableMap::getTableMap()
            ->getColumn(SpyResetPasswordTableMap::COL_STATUS)
            ->getPhpName();

        $statusValue = SpyResetPasswordTableMap::getTableMap()
            ->getColumn(SpyResetPasswordTableMap::COL_STATUS)
            ->getValueSetKey(SpyResetPasswordTableMap::COL_STATUS_EXPIRED);

        $this->getFactory()
            ->createPropelResetPasswordQuery()
            ->filterByFkUser($resetPasswordTransfer->getFkUserIdOrFail())
            ->filterByCode($resetPasswordTransfer->getCodeOrFail(), Criteria::NOT_EQUAL)
            ->update([
                $statusField => $statusValue,
            ]);

        return $resetPasswordTransfer;
    }

    protected function saveResetPassword(ResetPasswordTransfer $resetPasswordTransfer, SpyResetPassword $resetPasswordEntity): ResetPasswordTransfer
    {
        $resetPasswordEntity = $this->getFactory()
            ->createPropelResetPasswordMapper()
            ->mapResetPasswordTransferToResetPasswordEntity($resetPasswordTransfer, $resetPasswordEntity);

        $resetPasswordEntity->save();

        return $resetPasswordTransfer->setIdResetPassword($resetPasswordEntity->getIdAuthResetPassword());
    }
}
