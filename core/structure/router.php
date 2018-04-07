<?php 

if(function_exists("router"))
{
	
}
else
{
	function router($rType,$AccessURL,$currentx,$urlz,$route,$class,$types,$op1="",$op2="",$op3="",$op4="",$op5="",$op6="",$op7="",$op8="",$op9="",$op10=""){
		
		if($AccessURL=="")
		{
			$cc = explode("/",$currentx);
			
			$current = $cc[0];
		}
		else
		{
			$cc = explode("/",$currentx);
			
			$current = $cc[0]."/".$cc[1];
		}
		
		$count = count($types);
		
		$url = $AccessURL.$urlz;
		
		
		
	/////////////////////////////////////////////////TESTER START/////////////////////////////////////////////////
	if(strtoupper($rType[0])=="HEADER" || strtoupper($rType[0])=="FOOTER")
	{
		$x = 1;
	}
	else
	{
		if($count==0)
		{
			if($current==$url)
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==1)
		{
			if($current==$url || $current==$url.$types[0])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==2)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==3)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==4)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2] || $current==$url.$types[3])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==5)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2] || $current==$url.$types[3] || $current==$url.$types[4])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==6)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2] || $current==$url.$types[3] || $current==$url.$types[4] || $current==$url.$types[5])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==7)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2] || $current==$url.$types[3] || $current==$url.$types[4] || $current==$url.$types[5] || $current==$url.$types[6])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==8)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2] || $current==$url.$types[3] || $current==$url.$types[4] || $current==$url.$types[5] || $current==$url.$types[6] || $current==$url.$types[7])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==9)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2] || $current==$url.$types[3] || $current==$url.$types[4] || $current==$url.$types[5] || $current==$url.$types[6] || $current==$url.$types[7] || $current==$url.$types[8])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
		elseif($count==10)
		{
			if($current==$url || $current==$url.$types[0] || $current==$url.$types[1] || $current==$url.$types[2] || $current==$url.$types[3] || $current==$url.$types[4] || $current==$url.$types[5] || $current==$url.$types[6] || $current==$url.$types[7] || $current==$url.$types[8] || $current==$url.$types[9])
			{
				$x = 1;
			}
			else
			{
				$x = 0;
			}
		}
	}
	/////////////////////////////////////////////////TESTER END/////////////////////////////////////////////////
		
		//echo "test x: ".$x."<br>";
		
		
	/////////////////////////////////////////////////ROUTER START/////////////////////////////////////////////////
		if($x==1)
		{
			if(strtoupper($rType[0])=="HEADER")
			{			
				include find_file("apps/".$rType[1]."/layouts/pages/head.php");
				echo "<body>";
				include find_file("apps/".$rType[1]."/layouts/pages/app_header.php");
				//$GLOBALS["componentReg"] = 0;
				
				if($GLOBALS["THEME"]>=1)
				{
					componentReg();
					$GLOBALS["componentReg"] = 1;
				}
				
				
				
			}	
			
			if(strtoupper($rType[0])=="HEADER" || strtoupper($rType[0])=="FOOTER")
			{
				
			}
			else
			{
				if($class=="function")
				{

					if(function_exists($route))
					{
						if(strtoupper($rType[0])=="APP-EXCLUSIVE")
						{
							
						}
						else
						{
							include find_file("apps/".$rType[1]."/layouts/pages/head.php");
							echo "<body>";
							include find_file("apps/".$rType[1]."/layouts/pages/app_header.php");
						}
						
						if($GLOBALS["THEME"]>=1)
						{
							
						}
						else
						{
							componentReg();
							$GLOBALS["componentReg"] = 1;
						}
						
				
						if($op1=="" && $op2=="" && $op3=="" && $op4=="" && $op5=="" && $op6=="" && $op7=="" && $op8=="" && $op9=="" && $op10=="")
						{
							$route();
						}
						else
						{
							if(!($op1=="") && ($op2=="" && $op3=="" && $op4=="" && $op5=="" && $op6=="" && $op7=="" && $op8=="" && $op9=="" && $op10==""))
							{
								$route($op1);
							}
							elseif(!($op1=="") && !($op2=="") && ($op3=="" && $op4=="" && $op5=="" && $op6=="" && $op7=="" && $op8=="" && $op9=="" && $op10==""))
							{
								$route($op1,$op2);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && ($op4=="" && $op5=="" && $op6=="" && $op7=="" && $op8=="" && $op9=="" && $op10==""))
							{
								$route($op1,$op2,$op3);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && !($op4=="") && ($op5=="" && $op6=="" && $op7=="" && $op8=="" && $op9=="" && $op10==""))
							{
								$route($op1,$op2,$op3,$op4);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && !($op4=="") && !($op5=="") && ($op6=="" && $op7=="" && $op8=="" && $op9=="" && $op10==""))
							{
								$route($op1,$op2,$op3,$op4,$op5);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && !($op4=="") && !($op5=="") && !($op6=="") && ($op7=="" && $op8=="" && $op9=="" && $op10==""))
							{
								$route($op1,$op2,$op3,$op4,$op5,$op6);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && !($op4=="") && !($op5=="") && !($op6=="") && !($op7=="") && ($op8=="" && $op9=="" && $op10==""))
							{
								$route($op1,$op2,$op3,$op4,$op5,$op6,$op7);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && !($op4=="") && !($op5=="") && !($op6=="") && !($op7=="")  && !($op8=="") && ($op9=="" && $op10==""))
							{
								$route($op1,$op2,$op3,$op4,$op5,$op6,$op7,$op8);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && !($op4=="") && !($op5=="") && !($op6=="") && !($op7=="")  && !($op8=="") && !($op9=="") && ($op10==""))
							{
								$route($op1,$op2,$op3,$op4,$op5,$op6,$op7,$op8,$op9);
							}
							elseif(!($op1=="") && !($op2=="") && !($op3=="") && !($op4=="") && !($op5=="") && !($op6=="") && !($op7=="")  && !($op8=="") && !($op9=="") && !($op10==""))
							{
								$route($op1,$op2,$op3,$op4,$op5,$op6,$op7,$op8,$op9,$op10);
							}
						}
						
						if(strtoupper($rType[0])=="APP-EXCLUSIVE")
						{
							
						}
						else
						{
							include find_file("apps/".$rType[1]."/layouts/pages/app_footer.php");
							echo "</body>";
							echo "</html>";
						}	
					
						$return = 1;
					}
					else
					{
						//echo "SORRY! ROUTE TO FUNCTION NOT AVAILABLE.<BR>";
						$return = 0;
					}
				}
				elseif($class=="file")
				{
					if(strtoupper($rType[0])=="APP-EXCLUSIVE")
					{
						
					}
					else
					{
						include find_file("apps/".$rType[1]."/layouts/pages/head.php");
						echo "<body>";
						include find_file("apps/".$rType[1]."/layouts/pages/app_header.php");
					}
					
						if($GLOBALS["THEME"]>=1)
						{
							
						}
						else
						{
							componentReg();
							$GLOBALS["componentReg"] = 1;
						}
				
					if(strtoupper($rType[0])=="APP" || strtoupper($rType[0])=="APP-EXCLUSIVE")
					{
						include find_file("apps/".$rType[1]."/layouts/pages/".$route);
					}
					elseif(strtoupper($rType[0])=="THEME")
					{
						if($rType[1]=="")
						{
							include find_file("themes/".themeurl()."/".$route);
						}
						else
						{
							include find_file("themes/".themeurl()."/".$rType[1]."/".$route);
						}
					}
					elseif(strtoupper($rType[0])=="MIS")
					{
						if($rType[1]=="")
						{
							include find_file("mis/".$route);
						}
						else
						{
							include find_file("mis/".$rType[1]."/".$route);
						}
					}
					elseif(strtoupper($rType[0])=="PLUGIN")
					{
						if($rType[1]=="")
						{
							include find_file("plugins/".$route);
						}
						else
						{
							include find_file("plugins/".$rType[1]."/".$route);
						}
					}
					elseif(strtoupper($rType[0])=="FILE")
					{
						include find_file($rType[1].$route);
					}
					else
					{
						include find_file($rType[1].$route);
					}
					
					if(strtoupper($rType[0])=="APP-EXCLUSIVE")
					{
						
					}
					else
					{
						include find_file("apps/".$rType[1]."/layouts/pages/app_footer.php");
						echo "</body>";
						echo "</html>";
					}
				
					$return = 1;
				}
			}
			
			if(strtoupper($rType[0])=="FOOTER")
			{
				include find_file("apps/".$rType[1]."/layouts/pages/app_footer.php");
				echo "</body>";
				echo "</html>";
			}
		}
		else
		{
			$return = 0;
		}
		return $return;
	/////////////////////////////////////////////////ROUTER END/////////////////////////////////////////////////
	}
}
?>