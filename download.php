<?php 
 
@ini_set('error_reporting', E_ALL & ~ E_NOTICE);
@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 'Off');
	
if(!isset($_REQUEST['token']) || empty($_REQUEST['token']))
{
	header("HTTP/1.0 400 Bad Request");
	exit;
}
	
include "cnct.php";
include "sess.php";
include "plugins/includes/vars.php";
include "session.php";
include "mis/priv.php";
include "plugins/includes/functions.php";
include "mis/orgfiltermodule.php";
include "moment.php";


@$year = date(Y);
@$day = date(z);
@$hour = date(G);
@$hour2 = date(h);
@$mins = date(i);
@$sec = date(s);

$sess_id = rand(0, 9999999999998);
$sess_id2 = rand(9999999999999, 999999999999999999998);
$sess_id3 = rand(999999999999999999999, 99999999999999999999999999999999999);

$timex = ($year*365*24*60*60)+($day*24*60*60)+($hour*60*60)+($mins*60)+$sec;
$cccA = md5($timex." || ".$sess_id." || ".$userID." || ".$_SESSION[SesUID()]);
$cccB = md5($timex." |L| ".$sess_id2." |M| ".$userID." |N| ".$_SESSION[SesUID()]);
$cccC = md5($timex." |12A| ".$sess_id3." |13B| ".$userID." |14C| ".$_SESSION[SesUID()]);

$sel2 = $cccA;
@$create = mkdir("downloads/".$moment2);
@$create2 = mkdir("downloads/".$moment2."/".$sel2);
$sel2x = "downloads/".$moment2."/".$sel2."/";
				
				
$selQ = "SELECT COUNT(id) AS maxCount,data AS fileURL FROM meta WHERE userid = '".$_REQUEST['token']."' AND meta_data = '".md5('FILE_DOWNLOAD_SEQ')."';";				
//echo $selQ;
$resQ = mysqli_query($db,$selQ);
@$rwQ = mysqli_fetch_array($resQ);
$maxCount = $rwQ["maxCount"];
$fileURL = $rwQ["fileURL"];

//echo $fileURL;

$selQ2 = "SELECT COUNT(id) AS maxCount,data AS fileURL FROM meta WHERE userid = '".$_REQUEST['token']."' AND meta_data = '".md5('FILE_DOWNLOAD_SEQ2')."';";				
$resQ2 = mysqli_query($db,$selQ2);
@$rwQ2 = mysqli_fetch_array($resQ2);
$maxCount2 = $rwQ2["maxCount"];

//echo $maxCount2;

$selTr = "SELECT * FROM tracks WHERE id = '".$fileURL."';";
//echo $selTr;
$resTr = mysqli_query($db,$selTr);
$rowTr = mysqli_fetch_array($resTr);
$file_url = $rowTr["file_url"];	
$file_typeX = $rowTr["file_type"];	
$drt = explode("/",$file_typeX);
$tfile_type = $drt[1];
$track_title = $rowTr["track_title"];
$bitrate = $rowTr["bitrate"];
$albumV = $rowTr["album"];
$protectedV = $rowTr["protected"];

$selTr1 = "SELECT * FROM albums WHERE album = '".$albumV."';";
$resTr1 = mysqli_query($db,$selTr1);
$rowTr1 = mysqli_fetch_array($resTr1);
$album_url1 = $rowTr1["album"];	

$selTr2 = "SELECT * FROM meta WHERE meta_data = '".$file_url."';";
$resTr2 = mysqli_query($db,$selTr2);
$rowTr2 = mysqli_fetch_array($resTr2);
$file_nameX = $rowTr2["data"];
$useridX = $rowTr2["userid"];

$selTr3 = "SELECT * FROM meta WHERE meta_data = '".$albumV."';";
$resTr3 = mysqli_query($db,$selTr3);
$rowTr3 = mysqli_fetch_array($resTr3);
$album_nameX = $rowTr3["data"];

$selTr3z = "SELECT * FROM meta WHERE meta_data = '".$useridX."';";
$resTr3z = mysqli_query($db,$selTr3z);
$rowTr3z = mysqli_fetch_array($resTr3z);
$album_nameXz = $rowTr3z["data"];
$useridXz = $rowTr3z["userid"];

$destination_path = $sel2x."".$track_title.".".$tfile_type;
$destination_pathx = $sel2x;
$destination_pathy = $track_title.".".$tfile_type;
$source_path = "uploads/".$moment."/".$album_nameX."/".$file_nameX.".php";

$folder_url = "uploads/".$moment."/".$album_nameX;
$tfile_name = $file_nameX.".php";
$target_url = $sel2x."".$track_title;

$DCrpt2 = decrypt_my_file2($folder_url,$tfile_name,$target_url,$tfile_type,$useridXz,$album_nameXz,$bitrate);

if($maxCount2>="1" && chkSes()=="Inactive")
{
	echo "<p align='center'>This download link has already been used.</p>";
	$downloadaccess = 0;
}
elseif($maxCount>="1" && $maxCount2<="0" && chkSes()=="Inactive")
{
	$downloadaccess = 1;
}
elseif(chkSes()=="Active")
{
	$downloadaccess = 1;
}

if($downloadaccess == "1")
{
	
	$file_path  = $_REQUEST["track"];
	$path_parts = pathinfo("".$file_path);
	$file_name  = $path_parts['basename'];
	$file_ext   = $path_parts['extension'];
	$file_path  = './'.$file_name;
	 
	// allow a file to be streamed instead of sent as an attachment
	$is_attachment = isset($_REQUEST['stream']) ? false : true;
	 
	// make sure the file exists
		$file_size  = strlen($DCrpt2);
		
			// set the headers, prevent caching
			header("Pragma: public");
			header("Expires: -1");
			header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
			header("Content-Disposition: attachment; filename=\"$file_name\"");
	 
			// set appropriate headers for attachment or streamed file
			if ($is_attachment)
					header("Content-Disposition: attachment; filename=\"$file_name\"");
			else
					header('Content-Disposition: inline;');
	 
			// set the mime type based on extension, add yours if needed.
			$ctype_default = "application/octet-stream";
			$content_types = array(
					"exe" => "application/octet-stream",
					"zip" => "application/zip",
					"mp3" => "audio/mpeg",
					"mpg" => "video/mpeg",
					"avi" => "video/x-msvideo",
			);
			$ctype = isset($content_types[$file_ext]) ? $content_types[$file_ext] : $ctype_default;
			header("Content-Type: " . $ctype);
	 
			if(isset($_SERVER['HTTP_RANGE']))
			{
				list($size_unit, $range_orig) = explode('=', $_SERVER['HTTP_RANGE'], 2);
				if ($size_unit == 'bytes')
				{
					list($range, $extra_ranges) = explode(',', $range_orig, 2);
				}
				else
				{
					$range = '';
					header('HTTP/1.1 416 Requested Range Not Satisfiable');
					exit;
				}
			}
			else
			{
				$range = '';
			}
	 
			list($seek_start, $seek_end) = explode('-', $range, 2);
	 
			$seek_end   = (empty($seek_end)) ? ($file_size - 1) : min(abs(intval($seek_end)),($file_size - 1));
			$seek_start = (empty($seek_start) || $seek_end < abs(intval($seek_start))) ? 0 : max(abs(intval($seek_start)),0);
	 
			if ($seek_start > 0 || $seek_end < ($file_size - 1))
			{
				header('HTTP/1.1 206 Partial Content');
				header('Content-Range: bytes '.$seek_start.'-'.$seek_end.'/'.$file_size);
				header('Content-Length: '.($seek_end - $seek_start + 1));
			}
			else
			  header("Content-Length: $file_size");
	 
			header('Accept-Ranges: bytes');
	 
			set_time_limit(0);
			print(@$DCrpt2);
			ob_flush();
			flush();
 
			if(chkSes()=="Inactive")
			{
			$insertXAx = "INSERT INTO meta (id,userid,data,meta_data,syncstate) VALUES ('','".$_REQUEST['token']."','','".md5('FILE_DOWNLOAD_SEQ2')."','');";
			@$resINSXAx = mysqli_query($db,$insertXAx);
			}
			
			if($protectedV=="Yes")
			{
			$paidtoken = 1;
			}
			else
			{
			$paidtoken = 0;
			}

			$insTr2 = "INSERT INTO downloads (id,track,code,token,paidtoken,uid,expiryDate) VALUES ('','".$fileURL."','".$_REQUEST['token']."','1','".$paidtoken."','".$userID."','".$trailExpiry."');";
			$resTr2 = mysqli_query($db,$insTr2);
			
		exit;
}

mysqli_close($db);
?>