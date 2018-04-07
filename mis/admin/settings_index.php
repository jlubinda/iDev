<?php
 if(@ privacy('Secure|Priv')=='Granted')
{
	
}
else
{
include "mis/access_denied.php";
}
?>