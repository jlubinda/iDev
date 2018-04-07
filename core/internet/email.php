<?php 

if(function_exists('clean_my_email_string'))
{
	
}
else
{
	function clean_my_email_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}

}
 

if(function_exists('email'))
{
	
}
else
{
	function email($subject,$message,$from,$to,$cc="",$bc=""){

		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		$headers .= "CC: ". strip_tags($cc) . "\r\n";
		$headers .= "BCC: ". strip_tags($bc) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		if(@mail($to, clean_my_email_string($subject), clean_my_email_string($message), $headers))
		{
			return 1;
		}
		else
		{
			return 0;
		}
			//////////////////////MAILER////////////////////////////////////////////
	}
}
?>