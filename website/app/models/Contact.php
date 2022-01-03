<?php

namespace App\Models;

use Core\Model;
use PDO;

class Contact extends Model
{
    /**
    * Create new message in DB
    * @param string $contactName
    * @param string $contactEmail
    * @param string $contactMessage
    * @param string $userIp
    */
    public function create(
        $contactName, $contactEmail, $contactMessage, $userIp
    )
    {
        $pre_insert = "INSERT INTO $this->contact_ms (

            user_name,
            email,
            message,
            user_ip,
            created_at

        ) VALUES (?, ?, ?, ?, NOW())";

        $insert = $this->connect()->prepare($pre_insert);
        $insert->execute([

          $contactName, $contactEmail, $contactMessage, $userIp
        ]);
    }
}
