<?php

namespace Core;

use App\Controllers\MessageController;

trait Validator
{

    /** @var pattern for name */
    private static $namePattern = '/^[\w. \-]+$/u';

    /** @var pattern for email */
    private static $emailPattern = '/^[\w.\-]+@[\w.\-]+\.[A-Za-z]{2,6}$/';

    /** @var pattern for password */
    private static $passwordPattern = '/^[\w\-\_]{6,16}$/';

    /** @var pattern for uri */
    private static $uriPattern = '/^[a-z\-]+$/u';

    /** @var pattern for subscriber Hash */
    private static $subscriberHashPattern = '/^[\w]+$/u';

    /** @var pattern for message */
    private static $messagePattern = '/^[\w.!?\, \-\']+$/u';

    /**
     * Checks user's message
     * @param string $message The user's message
     */
    public static function checkMessage(string $message): int
    {
        return preg_match(self::$messagePattern, trim($message));
    }

    /**
     * Checks user's name
     * @param string $name The user's name
     */
    public static function checkName(string $name): int
    {
        return preg_match(self::$namePattern, trim($name));
    }

    /**
     * Checks the email
     * @param string $email The email address
     */
    public static function checkEmail(string $email): int
    {
        return preg_match(self::$emailPattern, trim($email));
    }

    /**
     * Checks the password
     * @param string $password The user's password
     */
    public static function checkPassword(string $password): int
    {
        return preg_match(self::$passwordPattern, trim($password));
    }

    /**
     * Checks the length of a string
     * @param string $text A string
     * @param int $length Desired length of the string
     * @return boolean True if length is OK, otherwise false
     */
    public static function checkLength(string $text, $length): bool
    {
        return mb_strlen(trim($text)) > 2 && mb_strlen(trim($text)) <= $length;
    }

    /**
     * Checks the uri part
     * @param string $uri The part of uri from $_SERVER['REQUEST_URI']
     */
    public static function checkUriPart(string $uri): int
    {
        return preg_match(self::$uriPattern, trim($uri));
    }

    /**
     * Checks subscriber's hash from email
     * @param string $subscriberHash The subscriber's hash from email
     */
    public static function checkSubscriberHash(string $subscriberHash): int
    {
        return preg_match(self::$subscriberHashPattern, trim($subscriberHash));
    }

    /**
     * Checks message
     * @param string $param input field Identifier (id)
     * @param string $message The user's message
     */
    public static function checkContactMessage(string $param, string $message): bool
    {
        if (
            !self::checkMessage($message) ||
            !self::checkLength($message, 300))
        {

            MessageController::showAlertMessageAndRedBorder($param);
            $error = true;

        } else {

            MessageController::showGreenBorder($param);
            $error = false;

        }

        // Returns 'true' if there is a mistake
        return $error;
    }

    /**
     * Checks name or last name or login
     * @param string $param input field Identifier (id)
     * @param string $nameOrLogin The user's name or first name or last name or login
     */
    public static function checkNameLastNameLogin(string $param, string $nameOrLogin): bool
    {
        if (
            !self::checkName($nameOrLogin) ||
            !self::checkLength($nameOrLogin, 50))
        {

            MessageController::showAlertMessageAndRedBorder($param);
            $error = true;

        } else {

            MessageController::showGreenBorder($param);
            $error = false;

        }

        // Returns 'true' if there is a mistake
        return $error;
    }

    /**
     * Checks email
     * @param string $param input field Identifier (id)
     * @param string $email The user's email
     */
    public static function checkUserEmail(string $param, string $email): bool
    {
        if (
            !self::checkEmail($email) ||
            !self::checkLength($email, 50))
        {

            MessageController::showAlertMessageAndRedBorder($param);
            $error = true;

        } else {

            MessageController::showGreenBorder($param);
            $error = false;

        }

        // Returns 'true' if there is a mistake
        return $error;
    }

    /**
     * Checks password
     * @param string $param input field Identifier (id)
     * @param string $userPw The user's password
     */
    public static function checkUserPw(string $param, string $userPw)
    {
        if (! self::checkPassword($userPw)) {

            MessageController::showAlertMessageAndRedBorder($param);
            $error = true;

        } else {

            MessageController::showGreenBorder($param);
            $error = false;

        }

        // Returns 'true' if there is a mistake
        return $error;
    }

}
