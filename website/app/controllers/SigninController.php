<?php

namespace App\Controllers;
session_start();

require_once 'autoloader.php';

use Core\Controller;
use Core\Validator;
use Core\Model;
use App\Models\Signin;
use App\Controllers\SessionsController;
use App\Controllers\MessageController;

class SigninController extends Controller
{
    /**
     * See below how the $_POST is handled:
     * 1. If form 'Sign In' was submited, see /app.js -- 10. Click 'Sign in' button
    */

    /**
     * Check input fields from the 'Sign in' Form
     *
     * @return $error 'false' if there are no 'bad' symbols, otherwise 'true'
     */
    public static function checkFormInputFields()
    {
        // Set variables from $_POST
        $userEmailSignin = $_POST['userEmailSignin'];
        $userPwSignin    = $_POST['userPwSignin'];

        $error = Validator::checkUserEmail("user-email-signin", $userEmailSignin) |
                 Validator::checkUserPw("user-pw-signin", $userPwSignin);

        return $error;
    }
}

// ----------------------------------------- 1. If form 'Sign In' was submited
if (isset($_POST['signinUser'])) {

    $coreModelObj = new Model();

    // Set $userPw to check if it exists in DB
    $userPw = hash('ripemd160', trim($_POST['userPwSignin']));

    // If 'true' it means there are some 'bad' characters
    if (SigninController::checkFormInputFields()) {

        MessageController::removeLoadImgAndFormMessages('user-signin');

    // If 'false' it means there is NO such email
    } elseif (! $coreModelObj->checkIfCellValueExists(

              'email', trim($_POST['userEmailSignin'])
           )) {

        MessageController::showPopupMessageFromCurrentForm('user-signin', 'email-not-exists');

    // If 'false' it means there is NO such password
    } elseif (! $coreModelObj->checkIfCellValueExists(

              'password', $userPw
           )) {

        MessageController::showPopupMessageFromCurrentForm('user-signin', 'password-not-exists');

    // * If OK, means NO errors
    } else {

        // We need 'id' and 'login' for $_SESSION['user']
        $userEmail = trim($_POST['userEmailSignin']);

        $modelObj = new Signin();
        $data = $modelObj->getIdAndLogin($userEmail);

        $userId    = $data->id;
        $userLogin = $data->login;

        // Set 'session' for the current user
        // The session now is:
        // $_SESSION['user'][0] = $userId, $_SESSION['user'][1] = $userLogin
        SessionsController::setUserSession($userId, $userLogin);
    }
}
