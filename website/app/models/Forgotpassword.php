<?php

namespace App\Models;

require_once "constants.inc.php";

use Core\Model;
use App\Controllers\MessageController;
use PDO;

class Forgotpassword extends Model
{
    /**
     * Check how many times the password of the current user was reset
     */
    public function checkHowManyTimesInfoWasReset($userId, $columnName)
    {
        $query = $this->connect()->query("SELECT
           $columnName
              FROM $this->reset_tb
                WHERE user_id = '$userId'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    /**
     * The user resets info for the first time
     */
    public function createNewRecordInResetTable($userId, $user_login, $user_email, $user_pw)
    {
        $pre_insert = "INSERT INTO $this->reset_tb (

            user_id,
            user_login,
            user_email,
            user_pw

        ) VALUES (?, ?, ?, ?)";

        $insert = $this->connect()->prepare($pre_insert);
        $insert->execute([

          $userId,
          $user_login,
          $user_email,
          $user_pw

        ]);
    }

    /**
    * Checks if 'cell value' exists
    */
    public function getOne($columnName, $cellValue)
    {
     $query = $this->connect()->query("SELECT
        id
           FROM $this->users_tb
             WHERE $columnName = '$cellValue'
     ");

       $data = $query->fetch(PDO::FETCH_OBJ);

       return $data;
    }

    // Save new user's password
    public function save($newUserPw, $currentEmail)
    {
        // Get user's 'id' from 'users' table to find out if this 'id' is existing
        //  in the table 'reset'
        $userId = $this->getOne('email', $currentEmail);

        // Check how many times the current password was reset
        $amount = $this->checkHowManyTimesInfoWasReset($userId->id, 'user_pw');

        // If 'NULL' it means the user not existing in 'reset' table
        if ($amount->user_pw == NULL) {

            // Create new record in 'reset' table for the current user
            $user_login = 0;
            $user_email = 0;
            $user_pw    = 1;

            $this->createNewRecordInResetTable($userId->id, $user_login, $user_email, $user_pw);

            // Update the password for the current user
            $pre_update = "UPDATE $this->users_tb SET

               password = ?

               WHERE email = ?";

            $update = $this->connect()->prepare($pre_update)->execute([

               $newUserPw,

               $currentEmail
            ]);

        } elseif ($amount->user_pw >= AMOUNT_OF_RESETS) {

            MessageController::showPopupMessageFromCurrentForm('user-reset-pw', 'reset-impossible');
        } else {

            // Update the password for the current user
            $pre_update = "UPDATE $this->users_tb SET

                password = ?

                WHERE email = ?";

            $update = $this->connect()->prepare($pre_update)->execute([

               $newUserPw,

               $currentEmail
            ]);

            // Update amount of updates for the current column(user_pw) in 'reset' table
            $pre_update = "UPDATE $this->reset_tb SET

                user_pw = user_pw + 1

                WHERE user_id = ?";

            $update = $this->connect()->prepare($pre_update)->execute([

                $userId->id
            ]);
        }
    }
}
