<?php
error_reporting(E_ALL & ~E_NOTICE);


include_once "uid.php";

session_start();
unset($_SESSION[SesUID()]);
SesUID("UNSET");
include_once "links.php";
header("Location: $link");
?>