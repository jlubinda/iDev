<?php

//error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('zlib.output_compression', 'On'); 
ini_set('zlib.output_compression_level', '1'); 

date_default_timezone_set("Africa/Lusaka");

include "config.php";
include "sess.php";
include "core.php";
include "apps.php";

idAccess("VARS");
idAccess("SESSION");
idAccess("FUNCTIONS");
idAccess("REDIRECT");
idAccess("ORG FILTER");
idAccess("PRIV");
idAccess("UI");

?>