<?php
$m->Subject = "New contact messege on {$data->www_address}";
$m->Body = "
<div style='width: 100%;'>
  <div style='max-width: 500px; margin: 0 auto 0 auto;padding: 1em 0.5em 0 0.5em;background: #fff;'>

    <h1 style='color: #1f4872;
      font-size: 1.8em;
      margin: 1em 0 2em 0;
      border-bottom: 1px solid #e5e5e5;'>{$data->company_name}</h1>

    <p style='color:#1f4872; margin: 0 0 2em 0; line-height: 1.7; font-size: 1.2em;'>
      From: <b>{$contactName}</b>
    </p>

    <p style='color: #050505;font-size: 1em; margin: 0 0 2em 0em; line-height: 1.7;'>
      {$contactMessage}
    </p>

  </div>
</div>
";
