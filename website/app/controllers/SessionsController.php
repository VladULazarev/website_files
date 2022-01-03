<?php

namespace App\Controllers;
session_start();

require_once 'autoloader.php';

use Core\Controller;
use App\Controllers\MessageController;

class SessionsController extends Controller
{
     /**
      * Class 'SessionsController' contains the methods to handle all $_SESSIONS for this app
      */

     /**
      * Set $_SESSION['user'] for the current user
      *
      * The seesion lokks like this:
      *  $_SESSION['user'][0] = $userId and $_SESSION['user'][1] = $userLogin
      *
      * @param string $userId id
      * @param string $userLogin login
      */
     public static function setUserSession(string $userId, string $userLogin)
     {
         $value = [$userId, $userLogin];
         $_SESSION['user'] = $value;

         MessageController::redirect('');
     }

     /**
      * Set a session without any conditions
      * @param string $sessionName The name of the session
      * @param string $value The value of the session
      */
     public static function setSimpleSession(string $sessionName, string $value)
     {
         $_SESSION[$sessionName] = $value;
     }

    /**
     * Unset the current $_SESSIONS
     * @param string $sessionName The name of the current $_SESSION
     *
     * Usage: SessionsController::unsetSession($sessionName);
     */
    public static function unsetSession(string $sessionName)
    {
        switch($sessionName) {

            case "user" :
              unset($_SESSION[$sessionName]);
                MessageController::redirect('');
                  break;

              case "current-email" :
                unset($_SESSION[$sessionName]);
                  break;

            default : echo "<h4>SessionHandler: Something went wrong!</h4>";
        }
    }
}

// Unset current session
if ($_POST['unsetSession']) {

    $sessionName = $_POST['sessionName'];
    SessionsController::unsetSession($sessionName);
}
