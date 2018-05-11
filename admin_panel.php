<?php
include_once 'init.php';
if($object->is_logged()) {
include_once 'admin_navbar.php';
include_once 'header.php';
include_once 'footer.php';
} else {
  print 'proszę się zalogować!';
}

?>
