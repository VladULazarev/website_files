<?php

namespace App\Controllers;

require_once 'autoloader.php';;

use Core\Controller;
use Core\Model;
use Core\View;
use App\Controllers\MessageController;
use PHPMailer;

class MailController extends Controller
{
    // Send the message to the new user and ask to confirm the registration
    public static function sendEmailAfterRegistraition(
        $userLogin,
        $userEmail,
        $userPw
    )
    {
        // Set object
        $modelObj = new Model();

        // Get needed data from 'config' table
        $data = $modelObj->index('config');

        // Get PHPMailer and send email
        require_once '../../vendor/phpmailer/PHPMailerAutoload.php';

        $m = new PHPMailer();

        $m->isSMTP();
        $m->SMTPAuth = true;
        $m->CharSet  = "UTF-8";
        //$m->SMTPDebug = 2;

        $m->Host       = $data->outgoing_mail_server;
        $m->Username   = $data->mail_box_from_host;
        $m->Password   = $data->mail_box_password;
        $m->SMTPSecure = $data->smtp;
        $m->Port       = $data->port;

        $m->isHTML();

        // Get the mail template
        require_once '../includes/mail-templates/register-mail.php';

        // $companyName is the header of the email
        $m->SetFrom($data->mail_box_from_host, $data->company_name);

        //$m->AddReplyTo($email,$name);

        // The email of THE receiver
        $m->AddAddress($userEmail, 'Our Team');

        // * If the email was sent
        if ($m->Send()){

            MessageController::showPopupMessageFromCurrentForm('register', 'user-was-added');

        // If something went wrong
        } else {

            MessageController::showPopupMessageFromCurrentForm('register', 'something-went-wrong');
        }
    }

    /**
     * Send the confirmation email if the user has confirmed the regisration
     *
     * @param $userEmail User's email
     * @param $subscrHash User's hash from $_GET
     */
    public static function sendConfirmationEmail(
        $userLogin,
        $userEmail,
        $userHash
    )
    {
        // Set object
        $modelObj = new Model();

        // Get needed data from 'config' table
        $data = $modelObj->index('config');

        // Get PHPMailer and send email
        require_once '../../vendor/phpmailer/PHPMailerAutoload.php';

        $m = new PHPMailer();

        $m->isSMTP();
        $m->SMTPAuth = true;
        $m->CharSet  = "UTF-8";
        //$m->SMTPDebug = 2;

        $m->Host       = $data->outgoing_mail_server;
        $m->Username   = $data->mail_box_from_host;
        $m->Password   = $data->mail_box_password;
        $m->SMTPSecure = $data->smtp;
        $m->Port       = $data->port;

        $m->isHTML();

        // Get the mail template
        require_once '../includes/mail-templates/confirmation-mail.php';

        // $companyName is the header of email
        $m->SetFrom($data->mail_box_from_host, $data->company_name);

        // $m->AddReplyTo($email,$name);

        // The email of THE receiver
        $m->AddAddress($userEmail, 'Our Team');

        // If the email was sent
        if ($m->Send()){

            MessageController::redirect("registration-confirmed");

        // If something went wrong
        } else {

            MessageController::showPopupMessageFromCurrentForm('register', 'something-went-wrong');
        }
    }

    /**
     * Send the email to the owner of the website about new ocntact message
     *
     * @param $contactName, $contactEmail, $contactMessage
     */
    public static function sendEmailToWebsiteOwner(
        $contactName,
        $contactEmail,
        $contactMessage
    )
    {
        // Set object
        $modelObj = new Model();

        // Get needed data from 'config' table
        $data = $modelObj->index('config');

        // Get PHPMailer and send email
        require_once '../../vendor/phpmailer/PHPMailerAutoload.php';

        $m = new PHPMailer();

        $m->isSMTP();
        $m->SMTPAuth = true;
        $m->CharSet  = "UTF-8";
        //$m->SMTPDebug = 2;

        $m->Host       = $data->outgoing_mail_server;
        $m->Username   = $data->mail_box_from_host;
        $m->Password   = $data->mail_box_password;
        $m->SMTPSecure = $data->smtp;
        $m->Port       = $data->port;

        $m->isHTML();

        // Get the mail template
        require_once '../includes/mail-templates/contact-message-mail.php';

        // $companyName is the header of email
        $m->SetFrom($data->mail_box_from_host, $data->company_name);

        // $m->AddReplyTo($email,$name);

        // The email of THE receiver
        $m->AddAddress($data->contact_email, 'Our Team');

        // If the email was sent
        if ($m->Send()){

            MessageController::showPopupMessageFromCurrentForm('contact', 'message-sent');

        // If something went wrong
        } else {

            MessageController::showPopupMessageFromCurrentForm('contact', 'something-went-wrong');
        }
    }
}
