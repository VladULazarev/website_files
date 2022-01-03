<?php

namespace App\Controllers;

use Core\Controller;

class MessageController extends Controller
{
    /**
     * Class 'Message Controller' shows messages for this app depending on user actions
     * Usage: MessageController::messageName('something');
     */

    public static function showAlertMessageAndRedBorder(string $param)
		{
				echo "
            <script>
                $('.{$param}-alert').fadeTo(500, 1);
                $('#{$param}').removeClass('input-ok-border').addClass('alert-border');
            </script>
        ";
    }

    /**
     * Shows 'green border' if input is OK for the current input field
		 * @param string $param Identifier of the current input field
     */
     public static function showGreenBorder(string $param)
 		{
 				echo "
            <script>
                $('#{$param}').removeClass('alert-border').addClass('input-ok-border');
            </script>
        ";
 		}

    /**
     * Shows the messages from 'current'
     */
		public static function showPopupMessageFromCurrentForm($folder, $param)
		{
			echo "<script>
								$('.{$folder}-form-pop-up').empty();
								$('.{$folder}-form-messages').load('/app/includes/popup-messages/{$folder}-form/{$param}.html');
								$('.form-messages').fadeTo(300, 1);
								$('input, textarea').removeClass('input-ok-border');
								$('input').val('');
                $('textarea').val('');
						</script>
					 ";
		}

    /**
     * Shows the messages from 'user-forgot-pw-form' form
     */
		public static function showPopupMessageFromCheckEmailForm($param)
		{
			echo "<script>
								$('.user-forgot-pw-form-pop-up').empty();
								$('.user-forgot-pw-form-messages').load('/app/includes/popup-messages/user-reset-pw-form/{$param}.html');
								$('.form-messages').fadeTo(300, 1);
								$('input, textarea').removeClass('input-ok-border');
								$('input, textarea').val('');
								$('.form-messages').empty();
						</script>
					 ";
		}

    // Remove 'load img' and '{$param}-form-messages'
    public static function removeLoadImgAndFormMessages($param) {
        echo "<script>$('.{$param}-form-pop-up, .{$param}-form-messages').empty();</script>";
    }

    // Remove 'load img' and '{$param}-form-messages' and input values
    public static function removeLoadImgAndFormMessagesAndInputValues($param) {
        echo "<script>$('.{$param}-form-pop-up, .{$param}-form-messages').empty();$('input').val('');</script>";
    }

    // Redirect
    public static function redirect($param) {
      //  echo "<script>$(location).attr('href', '/{$param}');</script>";
        echo "<meta http-equiv='refresh' content='0; URL=/{$param}'>";
    }
}
