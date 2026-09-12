<?php

session_start();

/* Destroy all session data */
$_SESSION = array();

/* Destroy the session */
session_destroy();

/* Return to admin login */
header("Location: login.php");
exit();

?>