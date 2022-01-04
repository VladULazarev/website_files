<?php
/**
 * 'View' for the Blog page
 *
 * @link https://domainename.com/account
 *
 * Contains all data we see on the Blog page between <main></main> html tags
 */
include("app/includes/if-user-not-signed-in.inc.php");

// Get user's info
$userData = new App\Models\Account();
$userData = $userData->getOne($_SESSION['user'][0]);
?>

<!-- Account info -->
<div class="content">

      <h1><?= $pageData->link_h1; ?></h1>

  <div class="row">

    <div class="col-lg-8 col-sm-11">

      <div class="account-block">

          <div class="row info-block">

              <div class="col-md-2 col-3 account-a">Login: </div>
              <div class="col-md-4 col-9 account-b">
                <div class="user-login-info"><?= $userData->login; ?></div>
                <div class="form-edit-user-login">
                  <input type="text"
                    class="form-control"
                    id="user-login"
                    maxlength="50"
                    placeholder="<?= $userData->login; ?>"
                    autocomplete="off">
                  <span class="user-login-alert">Wrong symbol or empty!</span>
                </div>
              </div>
              <div class="col-md-2 col-6 account-a">
                <button class="btn btn-account btn-edit-info user-login-edit"
                  data-user-id='<?= $userData->id; ?>'
                  data-value='user-login'>Edit</button>
              </div>

              <div class="col-md-2 col-6 account-a user-login-cancel">
                <button class="btn btn-account btn-edit-info btn-edit-info-cansel"
                  data-user-id='<?= $userData->id; ?>'
                  data-value='user-login'>Cancel</button>
              </div>

              <div class="col-md-2"></div>

          </div>

          <div class="row info-block">

            <div class="col-md-2 col-3 account-a">Email:</div>
            <div class="col-md-4 col-9 account-b">
              <div class="user-email-info"><?= $userData->email; ?></div>
              <div class="form-edit-user-email">
                <input type="email"
                  class="form-control"
                  id="user-email"
                  maxlength="50"
                  placeholder="<?= $userData->email; ?>"
                autocomplete="off">
                <span class="user-email-alert">Wrong symbol or empty!</span>
              </div>
            </div>

            <div class="col-md-2 col-6 account-a">
              <button class="btn btn-account btn-edit-info user-email-edit"
                data-user-id='<?= $userData->id; ?>'
                data-value='user-email'>Edit</button>
            </div>

            <div class="col-md-2 col-6 account-a user-email-cancel">
              <button class="btn btn-account btn-edit-info btn-edit-info btn-edit-info-cansel"
                data-user-id='<?= $userData->id; ?>'
                data-value='user-email'>Cancel</button>
            </div>

            <div class="col-md-2"></div>

          </div>

          <div class="account-form-messages form-messages"></div>
          <div class="account-form-pop-up"></div>

        </div> <!-- end Account-block -->

      </div> <!-- end col-lg-8-->

    <div class="col-lg-4 col-sm-1"></div>
  </div> <!-- end row -->
</div> <!-- end content -->
