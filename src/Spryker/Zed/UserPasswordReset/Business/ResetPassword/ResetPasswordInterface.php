<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\UserPasswordReset\Business\ResetPassword;

use Generated\Shared\Transfer\UserPasswordResetRequestTransfer;

interface ResetPasswordInterface
{
    public function requestPasswordReset(UserPasswordResetRequestTransfer $userPasswordResetRequestTransfer): bool;

    public function isValidPasswordResetToken(string $token): bool;

    public function setNewPassword(string $token, string $password): bool;
}
