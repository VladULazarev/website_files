<?php

namespace App\Controllers;
session_start();

require_once 'autoloader.php';

use Core\Controller;
use Core\Validator;
use Core\Model;
use App\Models\Register;
use App\Controllers\SessionsController;
use App\Controllers\MessageController;
use App\Controllers\MailController;

class RegisterController extends Controller
{
    /**
     * See below how the $_POST is handled
     * 1. If the form 'Register' was submited,
     *    $_POST comes from: /app.js -- 11. Click 'Register' button
     * 2. If the user is confirming the registration from the email
     * 3. If the user is deleting the registration from the email
     *
     * Note: $userHash is the value of the column 'password' from 'users' table
    */

    /**
     * Checks input fields from the Form
     * @return $error 'false' if there are no 'bad' symbols, otherwise 'true'
     */
    public static function checkFormInputFields()
    {
        // Set variables from $_POST
        $userLogin    = $_POST['userLogin'];
        $userName     = $_POST['userName'];
        $userLastName = $_POST['userLastName'];
        $userEmail    = $_POST['userEmail'];
        $userPw       = $_POST['userPw'];

        // Check
        $error = Validator::checkNameLastNameLogin("user-login", $userLogin) |
                 Validator::checkNameLastNameLogin("user-name", $userName) |
                 Validator::checkNameLastNameLogin("user-last-name", $userLastName) |
                 Validator::checkUserEmail("user-email", $userEmail) |
                 Validator::checkUserPw("user-pw", $userPw);

        return $error;
    }

    /**
     * Store the new user
     */
    public static function store()
    {
        // Set variables from $_POST
        $userLogin    = trim($_POST['userLogin']);
        $userName     = trim($_POST['userName']);
        $userLastName = trim($_POST['userLastName']);
        $userEmail    = trim($_POST['userEmail']);
        $userPw       = trim($_POST['userPw']);

        // Get the user's IP
  			$userIp = Model::getUsersIp();

        // Set password hash
    		$userPw = hash('ripemd160', $userPw);

        // Create new user
        $modelReg = new Register();

        $modelReg->create(
            $userLogin, $userName, $userLastName,
            $userEmail, $userPw, $userIp
        );

        // Send the email to the new user and ask to confirm the registration
        MailController::sendEmailAfterRegistraition($userLogin, $userEmail, $userPw);
    }
}

// -------------------------------------- 1. If a form 'Register' was submited
if (isset($_POST['registerUser'])) {

    $coreModelObj = new Model();

    // Set $userPw to check if it exists in DB
    $userPw = hash('ripemd160', trim($_POST['userPw']));

    // If 'true' it means there are some 'bad' characters
    if (RegisterController::checkFormInputFields()) {

        MessageController::removeLoadImgAndFormMessages('register');

    // If 'true' it means there is already such email
    } elseif ($coreModelObj->checkIfCellValueExists(

              'email', trim($_POST['userEmail'])
           )) {

        MessageController::showPopupMessageFromCurrentForm('register', 'email-exists');

    // If 'true' it means there IS already such password
    } elseif ($coreModelObj->checkIfCellValueExists(

              'password', $userPw
           )) {

        MessageController::showPopupMessageFromCurrentForm('register', 'password-exists');

    // If NO errors -> store the new user
    } else {

  	    RegisterController::store();
	  }
}

// ----------------------------  2. If the user is confirming the registration

// $_GET['registerHash'] comes from user's email,
//   if user pressed the button 'Confirm registration'
// The link in the email looks like:
// href='/app/controllers/RegisterController.php?registerHash={$userHash}'>Confirm Subscription</a>

elseif (isset($_GET['registerHash'])) {

		// Set var
		$userHash = $_GET['registerHash'];

		// Check if $userHash has 'bad' simbols or not
		if(!Validator::checkSubscriberHash($userHash)) {

				ErrorController::notFound();

		// If OK, check if the $userHash exists
		} else {

    		// Check
    		$modelObj = new Register();

        // Set 'confirmed' for the query as false, '0' value in the column 'confirmed'
        $confirmedStatus = false;

  		  // If there is no such $userHash or the user alredy registered ('confirmed == true)
  			if (!$modelObj->ifUserHashExists($userHash, $confirmedStatus)) {

            MessageController::redirect('already-registered');

  		  // If there is the $userHash
        //  and the user is not confirmed the suscription ('confirmed' == false)
  			} else {

            // Update user's 'confirmed', set '1'(true)
  		 			//$modelObj = new Register();
  					$modelObj->update($userHash);

  					// Get user's email and login fo email
  					$userObj = $modelObj->getUserEmailAndLogin($userHash);
  					$userEmail = $userObj->email;
            $userLogin = $userObj->login;

  					// Send the confirmation email to user
  					MailController::sendConfirmationEmail($userLogin, $userEmail, $userHash);
  			}
    }
}

// --------------------  3. If the user is deleting the account from the email

elseif (isset($_GET['unsubscribe'])) {

		// Set $unsubscribeHash
		$unsubscribeHash = $_GET['unsubscribe'];

    // Note: $unsubscribeHash is the value of the column 'password' from 'users' table

		// Check if $unsubscribeHash has 'bad' simbols or not
		if(!Validator::checkSubscriberHash($unsubscribeHash)) {

        ErrorController::notFound();

		// If OK, check if the $unsubscribeHash exists
		} else {

        $modelObj = new Register();
        $confirmedStatus = true;

        // Check
        $checkUsersHash = $modelObj->ifUserHashExists($unsubscribeHash, $confirmedStatus);

  			// If there is no such $subscrHash
				if (! $checkUsersHash) {

            // And user is redirected to: /already-unsubscribed
            MessageController::redirect('already-unsubscribed');

				// If there is the $subscrHash delete the user's data
				} else {

						$modelObj->delete($unsubscribeHash);

            // And user is redirected to: /you-unsubscribed
            MessageController::redirect('you-unsubscribed');
				}
		}
}
