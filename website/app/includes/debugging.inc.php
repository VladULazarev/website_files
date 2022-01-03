<?php
// * For debugging uncomment a line

 // $currentUri = $_SERVER['REQUEST_URI'];
 // $uriParts = explode('/', $currentUri);
 // echo '<pre>','<br>','<br>',print_r($uriParts),'</pre><br>';exit();

// unset($_SESSION[]);

echo '<br><p>SESSION array</p>';
echo '<pre>','</br>',print_r($_SESSION),'</pre><br>';

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
