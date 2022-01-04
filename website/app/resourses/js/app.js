/**
 CONTENT

 1. Functions
    1.1 Remove alert messages 'Wrong simbol or empty' and 'alert border'
        if there are any
    1.2 If not enough content to fill the current window
    1.3 Show/hide slide panel
 2. Events when Document is ready
 3. Evens on 'resize' the window
 4. Toggle icon .fa-angle-down near .accoutn-link
 5. Click the button 'Log Out'
 6. Set 'active' class for 'main-link' and disable 'click' event
 7. Click 'Close' button on pop up message
 8. If click 'user-was-registered' message
 9. Hide 'alert message' and 'alert border'
 		for the current field if it is 'on focus'
 10. Click 'Sign in' button
 11. Click 'Register' button
 12. Click 'Forgot your password?' button
    12.1 Click 'Check email' button after buton 'Forgot your password?' was clicked
 13. Click 'Submit' button after 'Forgot your password?' was clicked
 14. Click 'Set password' button
 15. Account
    15.1 Click 'Edit' button
    15.2 Click button 'Update' for the current '.info-block' and update the info
    15.3 Click button Close - 'reset-impossible'
    15.4 Click button Close - 'pw-reset-impossible'
    12.5 Click button Close - '.btn-password-reset'
 16. If click eye icon in a 'password' input field
 17. Contact form
    17.1. Click 'Close' after message was sent
 18. Slide panel
*/

// -------------------------------------------------------------- 1. Functions

// 1.1 Remove alert messages 'Wrong simbol or empty' and 'alert border' if there are any
function removeMessagesAndBorders(middleTime) {
    $("span[class*=alert]").fadeTo(middleTime, 0);
    $("input, textarea").removeClass("alert-border");
}

// ---------------------- 1.2 If not enough content to fill the current window

function ifNotEnoughContent(docHeight, windowHeight, carrentMainHeight) {
    var newMainHeight = carrentMainHeight + (docHeight - windowHeight);
    $('main').height(newMainHeight);
}

// -------------------------------------------------- 1.3 Show/hide slide panel

function showSlidePanel() {

    // Get the current height of the current screen
    var docHeight = $(document).height();

    // The panel is sliding in
    $("#panel").css({'transform': 'translateX(-1px)', '-ms-transform': 'translateX(-1px)'});

    // Apply the dark overlay
    window.setTimeout(function() {
        $("body").append("<div id='overlay'></div>");
        $("#overlay").height(docHeight + 100).animate({opacity: ".4"}, 200);
    }, 100);

    // Disable to scroll body
    setTimeout(function() {$('body').css({"overflow": "hidden"});}, 400);
}

function hideSlidePanel() {

    // The panel is sliding out
    $("#panel").css({'transform': 'translateX(-340px)', '-ms-transform': 'translateX(-340px)'});

    setTimeout(function() {$("#overlay").animate({opacity: '0' }, 'fast');}, 100);
    setTimeout(function() { $("#overlay").remove() }, 300);

    // Body can scroll
    setTimeout(function() {$("body").css({"overflow": "auto"});}, 400);
}

// ------------------------------------------ 2. Events when Document is ready
$(document).ready(function(){

    // Variables
    let shortTime  = 100;
    let middleTime = 300;
    let longTime   = 500;

    // Content shows up
    $(".content").fadeTo(longTime, 1);

    // Set the input field on focus
    $("#user-email-signin").focus();

    // Check the height of the current 'screen' and 'html' height
    var docHeight = $(document).height();  // Height of the screen
    var windowHeight = $('html').height();
    var carrentMainHeight = $('main').height();

    var windowWidth = $(window).width();

    // Increase the height of 'main' tagto fill in the current window (scren)
    if (docHeight > windowHeight) {

        ifNotEnoughContent(docHeight, windowHeight, carrentMainHeight);
    }

    // Set input field on focus if a form was loaded using ajax
    $(document).ajaxComplete(function(){
        $("#user-email-forgot-pw").focus();
    });

// ------------------------------------------- 3. Evens on 'resize' the window
$(window).resize(function() {

    // Check the height of the 'screen' and 'html' height
    var docHeight = $(document).height();  // Height of the screen
    var windowHeight = $('html').height();
    var carrentMainHeight = $('main').height();

    // Increase the height of 'main' to fill in the current window(scren)
    if (docHeight > windowHeight) {

        ifNotEnoughContent(docHeight, windowHeight, carrentMainHeight);
    }

    var windowWidth = $(window).width();

		if (windowWidth < 1400) {

				var panelHeight = window.innerHeight;

        // Set height of the slide panel on resize event
    		$("#panel").css({"height": docHeight});
    		$(".inner-panel").css({"height": panelHeight});
		}
});

// ------------------------------- 4. Hide/show account block from navigation

// If window width < 1400px
var accountTrigger = false;

$(".account-link").on("tap",function(){

    if (windowWidth <= 1400) {

        if (accountTrigger === false) {

            $(".account-popup").css({"visibility": "visible", "opacity": 1});
            $(".account-link i").toggleClass("fa-angle-down fa-angle-up");
            accountTrigger = true;

        } else if (accountTrigger === true) {

            $(".account-popup").css({"visibility": "hidden", "opacity": 0});
            $(".account-link i").toggleClass("fa-angle-up fa-angle-down");
            accountTrigger = false;
        }
    }
});

// If window width > 1400px
$('.account-link').on("mouseenter",function(){

    if (windowWidth > 1400) {
		    $(".account-link i").toggleClass("fa-angle-down fa-angle-up");
    }
});

$('.account-link').on("mouseleave",function(){

  if (windowWidth > 1400) {
      $(".account-link i").toggleClass("fa-angle-up fa-angle-down");
  }
});

// -------------------------------------------=-- 5. Click the button 'Log Out'
$(".log-out").on("click", function() {

		let sessionName = 'user';
		let unsetSession = 'unsetSession'; // $_POST identifier

		$.post("/app/controllers/SessionsController.php", {

				sessionName: sessionName,
				unsetSession: unsetSession

		}, function(data) {

					$("main").append(data);
		});
});

// ----------- 6. Set 'active' class for 'main-link' and disable 'click' event

$(".main-link").each(function() {

    if (this.href == window.location.href) {

    		$(this).addClass("main-link_active");
    }
});

$(".main-link_active").on("click", function(event) {

		event.preventDefault();
});

// --------------------------------- 7. Click 'Close' button on pop up message

$(document).on("click", ".btn-danger", function(event){

  	event.preventDefault();

    $("input").blur();

    $(".form-messages").fadeTo(middleTime, 0, function(){
        $(".form-messages").empty();
    });
});

// --------------------------------- 8. If click 'user-was-registered' message
$(document).on("click", ".user-was-registered", function(){

		event.preventDefault();

		$(".form-messages").fadeTo(middleTime, 0, function(){
				$(location).attr("href", "/sign-in");
		});
});

// -------------------------------- 9. Hide 'alert message' and 'alert border'
//	for the current input field if it is 'on focus'

$(document).on("keydown", "input, textarea", function(){

		$(this).next().fadeTo(middleTime, 0);
		$(this).removeClass("alert-border");

		$(".form-messages").empty();
});

// ------------------------------------------------ 10. Click 'Sign in' button

// Click 'btn-signin-user' button
$(".btn-signin-user").on('click', function(event) {

		event.preventDefault();

		removeMessagesAndBorders(middleTime);

		// Set variables
		let userEmailSignin = $("#user-email-signin").val();
		let userPwSignin = $("#user-pw-signin").val();
		let signinUser = "signin-user"; // The $_POST identifier

		// Load 'load img'
		$(".user-signin-form-pop-up").load("/app/includes/wait-for-load-is-done.html");

		// Set timeout while the script is loading
		setTimeout(function(){

				// Load the script
				$(".user-signin-form-messages").load("/app/controllers/SigninController.php", {

						userEmailSignin: userEmailSignin,
						userPwSignin: userPwSignin,
						signinUser: signinUser
				});

		}, longTime);
});

// ----------------------------------------------- 11. Click 'Register' button

// Click 'btn-register' button
$(".btn-register").on('click', function(event) {

		event.preventDefault();

		removeMessagesAndBorders(middleTime);

		// Set variables
		let userLogin = $("#user-login").val();
		let userName = $("#user-name").val();
		let userLastName = $("#user-last-name").val();
		let userEmail = $("#user-email").val();
		let userPw = $("#user-pw").val();
		let registerUser = "registerUser"; // The $_POST identifier

		// Load 'load img' while the script is loading
		$(".register-form-pop-up").load("/app/includes/wait-for-load-is-done.html");

		// Set timeout to show the 'load img' above while the script is loaded
		setTimeout(function(){

				// Load the script
				$(".register-form-messages").load("/app/controllers/RegisterController.php", {

						userLogin: userLogin,
						userName: userName,
						userLastName: userLastName,
						userEmail: userEmail,
						userPw: userPw,
						registerUser: registerUser
				});

		}, longTime);
});

// ---------------------------------- 12. Click 'Forgot your password?' button

$(".forgot-pw-link").on('click', function() {
    $("main").fadeTo(middleTime, 0, function() {
        $("main").empty().load("/app/includes/form-templates/forgot-password-form.html").fadeTo(shortTime, 1);
    });
});

// 13. Click 'Check email' button after buton 'Forgot your password?' was clicked

// Click 'btn-forgot-pw' button
$(document).on("click", ".btn-forgot-pw", function(event){

    event.preventDefault();

		removeMessagesAndBorders(middleTime);

		// Set variables
		let userEmailForgotPw = $("#user-email-forgot-pw").val();

		// Load 'load img'
		$(".user-forgot-pw-form-pop-up").load("/app/includes/wait-for-load-is-done.html");

		// Set timeout while the script is loading
		setTimeout(function(){

				// Load the script
				$(".user-forgot-pw-form-messages").load("/app/controllers/ForgotpasswordController.php", {

						userEmailForgotPw: userEmailForgotPw
				});

		}, longTime);
});

// ------------------------------------------- 14. Click 'Set password' button

// Click 'btn-reset-pw' button
$(document).on("click", ".btn-reset-pw", function(event){

    event.preventDefault();

		removeMessagesAndBorders(middleTime);

		// Set variables
		let userResetPw = $("#user-reset-pw").val();

		// Load 'load img'
		$(".user-reset-pw-form-pop-up").load("/app/includes/wait-for-load-is-done.html");

		// Set timeout while the script is loading
		setTimeout(function(){

				// Load the script
				$(".user-reset-pw-form-messages").load("/app/controllers/ForgotpasswordController.php", {

						userResetPw: userResetPw
				});

		}, longTime);
});

// --------------------------------------------------------------- 15. Account

// -------------------------------------------------- 12.1 Click 'Edit' button

// Click the button 'Edit' for the current '.info-block'
$(".btn-edit-info").on('click', function(event) {

    event.preventDefault();

    let fieldName = $(this).data("value");

    if ($(this).text() == 'Edit') {

        $("." + fieldName + "-info").fadeOut(function() {

            $(".form-edit-" + fieldName + "").fadeTo(shortTime, 1);
            $("." + fieldName + "-cancel").fadeTo(middleTime, 1);
        });

         $("." + fieldName + "-edit").fadeOut(function() {

             $("." + fieldName + "-edit").text('Update').fadeTo(shortTime, 1).blur();
         });

        return;

// 12.2 Click button 'Update' for the current '.info-block' and update the info
    } else if ($(this).text() == "Update") {

      	removeMessagesAndBorders(middleTime);

        let userId = $(this).attr('data-user-id');
        let columnName = $(this).data('value');
        let newColumnValue = $("#" + columnName).val(); // new email
        let updateAccountInfo = 'udate-account-info';

        // Load 'load img' while the script is loading
    		$(".account-form-pop-up").load("/app/includes/wait-for-load-is-done.html");

    		// Set timeout to show the 'load img' above while the script is loaded
    		setTimeout(function(){

    				// Load the script
    				$(".account-form-messages").load("/app/controllers/AccountController.php", {

    						userId: userId,
    						columnName: columnName,
    						newColumnValue: newColumnValue,
    						updateAccountInfo: updateAccountInfo
    				});

    		}, longTime);

        $(this).blur();

        return;

    } else if ($(this).text() == "Cancel") {

        event.preventDefault();

        let fieldName = $(this).data("value");

        $(".form-edit-" + fieldName + "").fadeOut(function() {

            $("." + fieldName + "-info").fadeTo(shortTime, 1);
        });

        $("." + fieldName + "-cancel").fadeTo(middleTime, 0);

        $("." + fieldName + "-alert").fadeTo(middleTime, 0);

        $("input").val('').removeClass('alert-border').addClass('ok-border');

        $("." + fieldName + "-edit").fadeOut(function() {

            $("." + fieldName + "-edit").text('Edit').fadeTo(shortTime, 1);
        });

        $(this).text("Cancel").blur();

        return;
    }
});

// ------------------------------ 15.3 Click button Close - '.reset-impossible'
   // if user reset login or email more than 3 times
$(document).on("click", ".reset-impossible", function(event){

    event.preventDefault();

    $(".form-messages").fadeTo(middleTime, 0, function(){
        $(location).attr("href", "/contact-us");
    });
});

// --------------------------- 15.4 Click button Close - 'pw-reset-impossible'
//    if user reset password more than 3 times
$(document).on("click", ".pw-reset-impossible", function(event){

    event.preventDefault();

    $(".form-messages").fadeTo(middleTime, 0, function(){
        $(location).attr("href", "/contact-us");
    });
});

// --------------------------- 15.5 Click button Close - '.btn-password-reset'
//    if user resets password
$(document).on("click", ".btn-password-reset", function(event){

    event.preventDefault();

    $(".form-messages").fadeTo(middleTime, 0, function(){
        $(location).attr("href", "/sign-in");
    });
});

// ------------------------- 16. If click eye icon in a 'password' input field

let eyeTrigger = false;

$(document).on("click", ".eye-icon-pw", function(event){

    $(".eye-icon-pw i").toggleClass("fa-eye-slash fa-eye");

    let inputId = $(this).attr('data-input-id');

    if (eyeTrigger == false) {

        $("#"  + inputId).attr('type', 'text');

        eyeTrigger = true;

    } else if (eyeTrigger == true) {

        $("#" + inputId).attr('type', 'password');

        eyeTrigger = false;
    }
});

// --------------------------------------------------------- 17. Contact form

// Click 'btn-send-contact' button
$(".btn-send-contact").on('click', function(event) {

		event.preventDefault();

		removeMessagesAndBorders(middleTime);

		// Set variables
		let contactName = $("#contact-name").val();
		let contactEmail = $("#contact-email").val();
		let contactMessage = $("#contact-message").val();
		let contactForm = "contact-form"; // The $_POST identifier

		// Load 'load img' while the script is loading
		$(".contact-form-pop-up").load("/app/includes/wait-for-load-is-done.html");

		// Set timeout to show the 'load img' above while the script is loaded
		setTimeout(function(){

				// Load the script
				$(".contact-form-messages").load("/app/controllers/ContactController.php", {

						contactName:    contactName,
						contactEmail:   contactEmail,
						contactMessage: contactMessage,
						contactForm:    contactForm
				});

		}, longTime);
});

// -------------------------------- 17.1. Click 'Close' after message was sent

$(document).on("click", ".message-sent", function(event){

		event.preventDefault();

		$(".form-messages").fadeTo(middleTime, 0, function(){
				$(".form-messages").empty();
		});
});

// ----------------------------------------------------------- 18. Slide panel

// Load 'Slide panel' when '$(document)' is ready
$('.mobile-content').load("/app/includes/slide-panel.inc.php");

setTimeout(function() {

		// Set the current height of 'Slide panel'
		var docHeight = $(document).height();
		var panelHeight = window.innerHeight;

		$("#panel").css({"height": docHeight});
		$(".inner-panel").css({"height": panelHeight});

		// Check if the links is 'active' and set class 'active'
	  $(".pn-link").each(function() {

	      if (this.href == window.location.href) {

	      		$(this).addClass("pn-link-active");
	      }
	  });

		// Disable 'tap' event for the 'active' link
		$(".pn-link-active").on("tap", function(event) {

				event.preventDefault();
		});

}, middleTime);

// Show Slide panel if 'tap' the menu button
$(document).on('tap', '.menu-btn', function(){

		showSlidePanel();
});

// Hide Slide panel on 'swipeleft' event
$(document).on('swipeleft', '#panel, #overlay', function(){

		hideSlidePanel();
});

// Hide Slide panel on 'tap' event
$(document).on('tap', '#overlay', function(){

		hideSlidePanel();
});

// Show Slide panel on 'swiperight' event
$(document).on('swiperight', 'html', function() {

		if (windowWidth <= 1400) {

		 		showSlidePanel();
		}
});

// Hide Slide panel if 'tap' a slide panel link
$(document).on('tap', '.pn-link', function() {

		var clickedLink = $(this).attr('href');

		// If the link has attr 'href' (if real link was clicked)
		if (clickedLink) {

				// Hide slide panel and only then open the clicked link
				event.preventDefault();
				hideSlidePanel();
				setTimeout(function() { $(location).attr('href', clickedLink)}, longTime);
		}
});

}); // end/ $(document).ready(
