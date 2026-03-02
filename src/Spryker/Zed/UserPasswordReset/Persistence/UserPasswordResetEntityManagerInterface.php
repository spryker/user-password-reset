<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\UserPasswordReset\Persistence;

use Generated\Shared\Transfer\ResetPasswordTransfer;

interface UserPasswordResetEntityManagerInterface
{
    public function createResetPassword(ResetPasswordTransfer $resetPasswordTransfer): ResetPasswordTransfer;

    public function updateResetPassword(ResetPasswordTransfer $resetPasswordTransfer): ResetPasswordTransfer;

    public function invalidatePreviousPasswordResets(ResetPasswordTransfer $resetPasswordTransfer): ResetPasswordTransfer;
}
