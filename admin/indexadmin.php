<?php session_start();

require '../config.php';

require '../functions.php';

validateSession();

require '../views/indexadmin.view.php';

?>