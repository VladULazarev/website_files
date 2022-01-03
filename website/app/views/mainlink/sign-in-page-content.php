<?php
/**
 * 'View' for the Sign In page
 *
 * @link https://domainname.com/sign-in
 *
 * Contains all data we see on the Sign in page between <main></main> tags
 */
 include "app/includes/if-user-signed-in.inc.php";

 ?>

<!-- Sign In -->
<div class="content">

    <h1><?= $pageData->link_h1; ?></h1>

    <p class="register-link">
      Please, sign in or <a href="/register">Register</a>
    </p>

  <div class="row">

    <div class="col-lg-4">

      <form class="signin-user">

        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="user-email-signin">Email</label>
              <input type="email"
                class="form-control"
                id="user-email-signin"
                maxlength="50"
                placeholder="Email"
                autocomplete="off">
              <span class="user-email-signin-alert">Wrong symbol or empty!</span>
              <span class="user-email-signin-asterisk">*</span>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="user-pw-signin">Password</label>
              <input type="password"
                class="form-control"
                id="user-pw-signin"
                maxlength="16"
                placeholder="Password"
                autocomplete="off">
              <span class="user-pw-signin-alert">Wrong symbol or empty!</span>
              <span class="user-pw-signin-asterisk">*</span>
              <span class="eye-icon-pw" data-input-id="user-pw-signin"><i class='fa fa-eye fa-fw'></i></span>
            </div>
          </div>
        </div>

        <div class="btn-container mt-3">
            <button class="btn btn-default btn-signin-user">Sign In</button>
        </div>

        <div class="user-signin-form-messages form-messages"></div>
        <div class="user-signin-form-pop-up"></div>

        <div class="forgot-pw-link">
          <li>Forgot your password?</li>
        </div>

      </form>

    </div> <!-- col-lg-8 -->

    <div class="col-lg-4"></div>
  </div>
 </div>
