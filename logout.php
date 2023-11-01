<?php
session_start();

session_destroy();

header("login.php");
exit;

?>