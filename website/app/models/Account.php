<?php

namespace App\Models;

use App\Controllers\SessionsController;
use App\Controllers\MessageController;
use Core\Model;
use PDO;

require_once 'constants.inc.php';

class Account extends Model
{
    /**
     * Check if user exists in 'reset' table
     */
    public function checkIfUserExitsInResetTable($userId)
    {
        $query = $this->connect()->query("SELECT
           id
              FROM $this->reset_tb
                WHERE user_id = '$userId'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    /**
     *  Check how many times the info (login or email) was reset
     */
    public function checkHowManyTimesInfoWasReset($userId, $columnName)
    {
        // Define $columnName which is being updated in 'reset' table
        $resetColumnName = "user_" . $columnName;

        $query = $this->connect()->query("SELECT
           $resetColumnName
              FROM $this->reset_tb
                WHERE user_id = '$userId'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    /**
     * Store the user's reset info in 'reset' table for the first time
     */
    public function store($userId, $user_login, $user_email, $user_pw)
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
     * Get user's data (just in case, not using so far)
     */
    public function getOne($userId)
    {
        $query = $this->connect()->query("SELECT
           *
              FROM $this->users_tb
                WHERE id = '$userId'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    /**
     * Save new info (login or email) in 'users' table
     * @param string $userId
     * @param string $columnName
     * @param string $value
      */
    public function save($userId, $columnName, $columnValue)
    {
        // Check if user exists in 'reset' table
        if (! $this->checkIfUserExitsInResetTable($userId)) {

  // * If user not exists in 'reset' table -> update info in 'users' table
            $pre_update = "UPDATE $this->users_tb SET

                $columnName = ?

                WHERE id = ?";

            $update = $this->connect()->prepare($pre_update)->execute([

                $columnValue,

                $userId
            ]);

            // Store, how many times the current info (login or email) were updated
            //   in 'reset' table for the first time

            // We need to set values for all columns in 'reset' table except 'user_id'
            // Define column names and values which are being updated in 'reset' table
            if ($columnName == 'login') {

              // Set values for all columns in 'reset' table
                $user_login = 1;
                $user_email = 0;
                $user_pw    = 0;

            } elseif ($columnName == 'email') {

                // Set values for all columns in 'reset' table
                $user_login = 0;
                $user_email = 1;
                $user_pw    = 0;
            }

            // Store data in 'reset' table
            $this->store($userId, $user_login, $user_email, $user_pw);

            if ($columnName == 'login') {

                // Reset $_SESSION['user']
                SessionsController::setUserSession($userId, $columnValue);
            }

            // Reload the /account page and show updated info
            MessageController::redirect("account");

  // * If user exists in 'reset' table
        } else {

            // Check how many times the current info was reset
            $amount = $this->checkHowManyTimesInfoWasReset($userId, $columnName);

            // Define $columnName which is being updated in 'reset' table
            $resetColumnName = "user_" . $columnName;

            // Check the amount of updates
            if ($amount->$resetColumnName >= AMOUNT_OF_RESETS) {

                MessageController::showPopupMessageFromCurrentForm('account', 'reset-impossible');

            } else {

                // Update current info (login or email) in 'users' table
                $pre_update = "UPDATE $this->users_tb SET

                    $columnName = ?

                    WHERE id = ?";

                $update = $this->connect()->prepare($pre_update)->execute([

                    $columnValue,

                    $userId
                ]);

                // Update amount of updates for the current column in 'reset' table
                $pre_update = "UPDATE $this->reset_tb SET

                    $resetColumnName = $resetColumnName + 1

                    WHERE user_id = ?";

                $update = $this->connect()->prepare($pre_update)->execute([

                    $userId
                ]);

                if ($columnName == 'login') {

                    // Reset $_SESSION['user']
                    SessionsController::setUserSession($userId, $columnValue);
                }

                // Reload the /account page and see updated info
                MessageController::redirect("account");
            }
        }
    }
}
