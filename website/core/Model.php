<?php

namespace Core;

use App\Controllers\ErrorController;
use PDO;

class Model extends DbConnection
{
    /** @var string $users_tb name of the DB table 'users' */
    protected $users_tb = 'users';

    /** @var string $config_tb name of the DB table 'config' */
    protected $config_tb = 'config';

    /** @var string $main_links_tb name of the DB table 'main_links' */
    protected $main_links_tb = 'main_links';

    /** @var string $reset_tb name of the DB table 'reset' */
    protected $reset_tb = 'reset';

    /** @var string $contact_ms name of the DB table 'contact_messages' */
    protected $contact_ms = 'contact_messages';

    /**
     * Gets all records from the current table
     * @param int $tableName of the current table
     * @return Object $data instance of PDO Statement
     */
    public function index(string $tableName)
    {
        $query = $this->connect()->query("SELECT
            *
             FROM $tableName
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    /**
     * Get user's IP
     * Usage: $userIp = Model::getUsersIp();
     * @return string $ip User's IP
     */
    public static function getUsersIp()
    {
        // Check ip from share internet
        if (! empty($_SERVER['HTTP_CLIENT_IP']))
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * Example: checks if 'email' or 'login' exist in 'users' table
     */
    public function checkIfCellValueExists($columnName, $columnValue)
    {
        $query = $this->connect()->query("SELECT
           id
              FROM $this->users_tb
                WHERE $columnName = '$columnValue'
        ");

        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    /**
     * Check the amount of the same value in the current column
     */
    public function checkAmountOfTheSameValueInOneColumn($tableName, $columnName, $columnValue)
    {
        $query = $this->connect()->query("SELECT
           id
              FROM $tableName
                WHERE $columnName = '$columnValue'
        ");

        $amountOfRecords = $query->rowCount();

        return $amountOfRecords;
    }

    /**
     * Checks if $data is 'true' or 'false'
     * @param Object $data instance of PDO Statement
     * @throws ErrorController if $data is 'false' - means nothing was founded
     *  otherwise 'true' - means at least one row is matching the $query
     */
    public function checkIfDataExists($data)
    {
        if (! $data) {
            ErrorController::notFound();
        }
    }
}
