<?php
// * If user signed in

if ($_SESSION['user'][1] !== NULL) {
  echo "<script>$(location).attr('href', '/');</script>";
}
