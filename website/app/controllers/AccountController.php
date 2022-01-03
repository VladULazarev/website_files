<?php

namespace App\Controllers;
session_start();

require_once 'autoloader.php';

use Core\Controller;
use Core\Validator;
use Core\Model;
use App\Models\Account;
use App\Controllers\SessionsController;
use App\Controllers\MessageController;

class AccountController extends Controller
{
    /**
     * Updates user's info, data comes from app.js -- 15.2 Click button 'Update'
     */
    public static function update($userId, $columnName, $columnValue) {

        $modelObj = new Account();

        // Rename $columnValue and set it as coLumn name in 'users' table
        ($columnName == 'user-login') ? $columnName = 'login' : '';
        ($columnName == 'user-email') ? $columnName = 'email' : '';

        $modelObj->save($userId, $columnName, $columnValue);
    }
}

// ---------------------------------------- 1. If 'Upadate' button was clicked
//  $_POST comes from /app.js see,---
//  15.2 Click button 'Update' for the current '.info-block' and update the info

if (isset($_POST['updateAccountInfo'])) {

    $coreModelObj = new Model();

    // If 'login' is being updated
    if ($_POST['columnName'] == "user-login") {

        // If returns 'true'
        if (Validator::checkNameLastNameLogin("user-login", $_POST['newColumnValue'])) {

            MessageController::removeLoadImgAndFormMessagesAndInputValues('account');

        // If returns 'true'
        } elseif ($coreModelObj->checkIfCellValueExists(

                'login', trim($_POST['newColumnValue'])
            )) {

            MessageController::showPopupMessageFromCurrentForm('account', 'login-exists');

        // If returns 'false' update user's email
        } else {

            AccountController::update(
                $_POST['userId'],
                $_POST['columnName'],
                $_POST['newColumnValue']
            );
        }

    // If 'email' is being updated
    } elseif ($_POST['columnName'] == "user-email") {

        // If returns 'true'
        if (Validator::checkUserEmail(

              "user-email", $_POST['newColumnValue']
            )) {

            MessageController::removeLoadImgAndFormMessagesAndInputValues('account');

        // If returns 'true'
        } elseif ($coreModelObj->checkIfCellValueExists(

                  'email', trim($_POST['newColumnValue'])
               )) {

            MessageController::showPopupMessageFromCurrentForm('account', 'email-exists');

        //  If returns 'false' update user's email
        } else {

            AccountController::update(
                $_POST['userId'],
                $_POST['columnName'],
                $_POST['newColumnValue']
            );
        }
    }
}
