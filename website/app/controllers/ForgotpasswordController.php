<?php

namespace App\Controllers;
session_start();

require_once 'autoloader.php';

use Core\Controller;
use Core\Validator;
use Core\Model;
use App\Models\Forgotpassword;
use App\Controllers\SessionsController;
use App\Controllers\MessageController;

class ForgotpasswordController extends Controller
{
    /**
     * How the $_POST is handled
     * 1. If form 'Check email' was submited
     * 2. Reset passowrd
     */

    // Update user's password
    public static function update($newUserPw, $currentEmail)
    {
        // Set password hash
        $newUserPw = hash('ripemd160', $newUserPw);

        // Save password
        $modelObj = new Forgotpassword();
        $modelObj->save($newUserPw, $currentEmail);

        MessageController::showPopupMessageFromCurrentForm('user-reset-pw', 'password-was-reset');

        // unset session, we do not need it
        SessionsController::unsetSession('current-email');
    }
}

// ------------------------------------- 1. If form 'Check email' was submited

// $_POST comes from, see /app.js ----
//  --- 12.1 Click 'Check email' button after 'Forgot your password?' was clicked
if (isset($_POST['userEmailForgotPw'])) {

    $coreModelObj = new Model();

    // If 'true' it means there are some 'bad' characters
    if (Validator::checkUserEmail(

          "user-email-forgot-pw", trim($_POST['userEmailForgotPw'])
        )) {

        MessageController::removeLoadImgAndFormMessagesAndInputValues('user-forgot-pw');

    // If 'false' it means there is no such email
    } elseif (! $coreModelObj->checkIfCellValueExists(

              'email', trim($_POST['userEmailForgotPw'])
           )) {

        MessageController::showPopupMessageFromCheckEmailForm('email-not-exists');

    // If $error == false
    } else {

        // Create $_SESSION['current-email'] for  --- 2. Reset passowrd (see below)
        SessionsController::setSimpleSession('current-email', $_POST['userEmailForgotPw']);

        // Echo 'Reset password' form
        echo "
        <script>
            $('main').fadeTo(100, 0, function() {
                $('main').empty().load('/app/includes/form-templates/reset-password-form.html').fadeTo(100, 1);
            });
        </script>
        ";
    }
}

// --------------------------------------------------------- 2. Reset passowrd

// $_POST comes from, see /app.js ---- 14. Click 'Set password' button
if (isset($_POST['userResetPw'])) {

    $coreModelObj = new Model();

    // Set $userPw to check if it exists in DB
    $userPw = hash('ripemd160', trim($_POST['userResetPw']));

    // If 'true' it means there are some 'bad' characters
    if (Validator::checkUserPw(

          "user-reset-pw", trim($_POST['userResetPw'])
        )) {

        MessageController::removeLoadImgAndFormMessagesAndInputValues('user-reset-pw');

    // If 'true' it means there is already such password
    } elseif ($coreModelObj->checkIfCellValueExists(

              'password', $userPw
           )) {

        MessageController::showPopupMessageFromCurrentForm('user-reset-pw', 'password-exists');

    // If NO errors -> update password
    } else {

        ForgotpasswordController::update($_POST['userResetPw'], $_SESSION['current-email']);
	  }
}
