<?php

namespace App\Models;

use Core\Model;
use PDO;

class Signin extends Model
{
    /**
     * Get 'id' and 'login' using currrent 'email'
     */
    public function getIdAndLogin(string $userEmail)
    {
        $query = $this->connect()->query("SELECT
            id, login
               FROM $this->users_tb
                 WHERE email = '$userEmail'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }
}
