<?php

	if(chkSes()=="Active")
	{
	$PageIDx = $_REQUEST['ref']."|".$_REQUEST['segment']."|".$_REQUEST['function']."|".$_REQUEST['unit'];
							
									
							//echo "<span class='xxd'><b>".$FirstName." ".$LastName."</b></span> &nbsp;&nbsp;&nbsp;&nbsp;";
							
							$select_sys_comp = "SELECT * FROM sys_pages WHERE PageID = '".$PageIDx."';";
							@$res_sys_pages = mysqli_query($db,$select_sys_comp);
							@$num_sys_pages = mysqli_num_rows($res_sys_pages);
							
							//echo "Number of Page Details: ".$num_sys_pages."<br>";
							
							for($f=0;$f<$num_sys_pages; $f++)
							{
							$row_f = mysqli_fetch_array($res_sys_pages);
							$page_ID = "Page ID: ".$row_f["PageID"]."<br>";
							$page_name = $row_f["name"]." ";
							$page_description = "Page Description: ".$row_f["description"]."<br>";
							
							//echo "Current Page: ".$page_name."";
							}
	
	
							
								if($num_sys_pages>="1")
								{
								$registerdX = "2";
								}
								else
								{
									$registerdX = "1";
									echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='?ref=settings&segment=h1&function=add&regid=".$PageIDx."'>Click here to register this component.</a>";
								}
}
?>