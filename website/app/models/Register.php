<?php

namespace App\Models;

use Core\Model;
use PDO;

// Note: $userHash is the value of the column 'password' from 'users' table

class Register extends Model
{
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

    /**
     * Checks if user's 'hash' exists
     */
    public function ifUserHashExists($userHash, $confirmedStatus)
    {
        $query = $this->connect()->query("SELECT
            id
              FROM $this->users_tb
                WHERE password = '$userHash'
                AND confirmed = '$confirmedStatus'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    /**
    * Create new user
    * @param string $userLogin
    * @param string $userName
    * @param string $userLastName
    * @param string $userEmail
    * @param string $userPw
    * @param string $userIp
    * @param string $userHash
    */
    public function create(
        $userLogin,
        $userName,
        $userLastName,
        $userEmail,
        $userPw,
        $userIp
    )
    {
        $pre_insert = "INSERT INTO $this->users_tb (

            login,
            name,
            last_name,
            email,
            password,
            ip,
            created_at

        ) VALUES (?, ?, ?, ?, ?, ?, NOW())";

        $insert = $this->connect()->prepare($pre_insert);
        $insert->execute([

          $userLogin,
          $userName,
          $userLastName,
          $userEmail,
          $userPw,
          $userIp
        ]);
    }

    // Update user's status - confirmed (1)
    public function update($userHash)
    {
        $pre_update = "UPDATE $this->users_tb SET

            confirmed = ?

            WHERE password = ?";

        $update = $this->connect()->prepare($pre_update)->execute([

            1,

            $userHash
        ]);
    }

    /**
     * Get email and login
     */
    public function getUserEmailAndLogin($userHash)
    {
      $query = $this->connect()->query("SELECT
         email, login
            FROM $this->users_tb
              WHERE password = '$userHash'
      ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    // Delete the current user
    public function delete($unsubscribeHash)
    {
        $delete = $this->connect()->prepare("DELETE
            FROM $this->users_tb
            WHERE password = ?"
        );

        $delete->execute([$unsubscribeHash]);
    }
}
