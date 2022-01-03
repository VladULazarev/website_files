<?php

namespace App\Controllers;
session_start();

require_once 'autoloader.php';

require_once '../models/constants.inc.php';

use Core\Controller;
use Core\Validator;
use Core\Model;
use App\Models\Contact;
use App\Controllers\MessageController;
use App\Controllers\MailController;

class ContactController extends Controller
{
    /**
     * See below how the $_POST is handled
     *  $_POST comes from: /app.js -- 18. Contact form
    */

    /**
     * Checks input fields from the Form
     * @return $error 'false' if there are no 'bad' symbols, otherwise 'true'
     */
    public static function checkFormInputFields()
    {
        // Set variables from $_POST
        $contactName     = $_POST['contactName'];
        $contactEmail    = $_POST['contactEmail'];
        $contactMessage  = $_POST['contactMessage'];

        // Check
        $error = Validator::checkNameLastNameLogin("contact-name", $contactName) |
                 Validator::checkUserEmail("contact-email", $contactEmail) |
                 Validator::checkContactMessage("contact-message", $contactMessage);

        return $error;
    }

    /**
     * Store the new contact messsage
     */
    public static function store()
    {
        // Set variables from $_POST
        $contactName     = $_POST['contactName'];
        $contactEmail    = $_POST['contactEmail'];
        $contactMessage  = $_POST['contactMessage'];

        $userIp = Model::getUsersIp();

        // Create new maessage
        $modelCon = new Contact();

        $modelCon->create(
            $contactName, $contactEmail, $contactMessage, $userIp
        );

        // Send the email to the owner of the website about new contact message
        MailController::sendEmailToWebsiteOwner(
            $contactName, $contactEmail, $contactMessage
        );
    }
}

// --------------------------------------- 1. If a form 'Contact' was submited
if (isset($_POST['contactForm'])) {

    $userIp = Model::getUsersIp();

    $coreModelObj = new Model();

    // If 'true' it means there are some 'bad' characters
    if (ContactController::checkFormInputFields()) {

        MessageController::removeLoadImgAndFormMessages('contact');

    // If 'true' it means there is already such IP more than 3 times
    } elseif ($coreModelObj->checkAmountOfTheSameValueInOneColumn(

            'contact_messages', 'user_ip', $userIp
        ) >= AMOUNT_OF_CONTACT_MESSANGES) {

        MessageController::showPopupMessageFromCurrentForm('contact', 'ip-exists');

    // If NO errors -> store the new message
    } else {

        ContactController::store();
    }
}
