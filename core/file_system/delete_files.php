<?php
if(function_exists('delete_files'))
{
	
}
else
{
	 
	function delete_files($target) {
		
		$a=0;
				
		if(is_dir($target))
		{
			$files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
			
				
			foreach( $files as $file )
			{
				
				if(@delete_files( $file )>="1")
				{
					$a=$a+1;
				}	
				else
				{
					$a=$a;
				}
			}
		  
			if(rmdir( $target ))
			{
				$a=$a+1;
			}	
			else
			{
				$a=$a;
			}
		}
		elseif(is_file($target)) 
		{
			if(@unlink( $target ))
			{
				$a=$a+1;
			}	
			else
			{
				$a=$a;
			}
		}
		echo "Dir:".$a."<br>";
		return $a;
	}
}
?>