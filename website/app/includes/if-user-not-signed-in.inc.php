<?php
// * If user not signed in

if ($_SESSION['user'][1] === NULL) {
  echo "<script>$(location).attr('href', '/sign-in');</script>";
}
