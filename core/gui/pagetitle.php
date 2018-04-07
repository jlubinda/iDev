<?php	
if(function_exists('pagetitle'))
{
	
}
else
{
	function pagetitle($x){

	$pgArray = explode("/", $x);
	$numPages = count($pgArray);


	$pidx = $pgArray[0];
	$pageArray = explode(".",$pidx);
	$a = $pageArray[0];

		include find_file("cnct.php");	
		
		$selMn = "SELECT * FROM _pages WHERE id = '".$a."' OR name = '".$a."';";
		@@$resMn = mysqli_query($db,$selMn);
		@$num = mysqli_num_rows(@$resMn);
		@$rwM = mysqli_fetch_array(@$resMn);
		$id = $rwM["id"];	
		$title = $rwM["title"];	
		
		mysqli_close($db);
				
		return $title;
	}
}
?>