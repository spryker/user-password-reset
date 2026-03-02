<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\UserPasswordReset\Persistence;

use Generated\Shared\Transfer\ResetPasswordCriteriaTransfer;
use Generated\Shared\Transfer\ResetPasswordTransfer;

interface UserPasswordResetRepositoryInterface
{
    public function findOne(ResetPasswordCriteriaTransfer $resetPasswordCriteriaTransfer): ?ResetPasswordTransfer;
}
