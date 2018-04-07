<?php 
 // this will return bcdefghijk
 echo substr('abcdefghijk', 1);
 echo "<br>";
 
 // this will return defghijk
 echo substr('abcdefghijk', 3);
 echo "<br>";
 
 // this will return abc
 echo substr('abcdefghijk', 0, 3);
 echo "<br>";
 
 // this will return ijk
 echo substr('abcdefghijk', -3);
 echo "<br>";
 
 // this will return bcdefghij
 echo substr('abcdefghijk', 1, -1);
 echo "<br>";
 
 // this will return cdefgh
 echo substr('abcdefghijk', 2, -3);
 echo "<br>";
 //http://heartofangel.com/google-contact-sync-install/setup.exe
 ?> 