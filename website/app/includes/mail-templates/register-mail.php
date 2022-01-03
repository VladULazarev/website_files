<?php
$m->Subject = "Confirm your registration on {$data->www_address}";
$m->Body = "
<div style='width: 100%;'>
  <div style='max-width: 500px; margin: 0 auto 0 auto;padding: 1em 0.5em 0 0.5em;background: #fff;'>

    <h1 style='color: #1f4872;
      font-size: 1.8em;
      margin: 1em 0 2em 0;
      border-bottom: 1px solid #e5e5e5;'>{$data->company_name}</h1>

    <p style='color: #1f4872; margin: 0 0 1em 0; line-height: 1.7; font-size: 1.2em;'>
      <b>Dear {$userLogin},</b>
    </p>

    <p style='color: #050505;font-size: 1em; margin: 0 0 1em 0em; line-height: 1.7;'>
      Your registration is nearly completed.<br>
      Please, click the button below to confirm your registration.
    </p>

    <p style='color: #050505;font-size: 1em; margin: 0 0 1em 0em; line-height: 1.7;'>
      The confirmation link will be active for 24 hours.
    </p>

    <p style='color: #050505;font-size: 1em; margin: 0 0 2em 0em; line-height: 1.7;'>
      If you do not confirm the registration all your data will be deleted.
    </p>

    <p style='color: #050505;font-size: 1em; margin: 0 0 2em 0em; line-height: 1.7;text-align: center;'>
      <a style='padding: 0.4em 3em;
        display: inline-block;
        color:#fff!important;
        background-color: #1f4872;
        border: none;
        text-decoration: none;
        text-align: center;'
        href='{$data->address}/app/controllers/RegisterController.php?registerHash={$userPw}'>Confirm Registrarion
      </a>
    </p>

    <p style='color: #0b1b2a;font-size: 1em; margin: 0 0 2em 0em; line-height: 1.7;'>
        You will be redirected to The Confirm Page.
    </p>

    <p style='color: #0b1b2a;font-size: 1em; margin: 0 0 3em 0em; line-height: 1.7;'>
        Thank You!
    </p>

  </div>
</div>
";
