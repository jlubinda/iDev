<?php 

function getSliderImages($id,$type=""){

	$sel = "SELECT * FROM meta WHERE userid = '".$id."' AND meta_data = '".md5("HOME PAGE SLIDER IMAGE")."';";
	$res = mysqli_query($db,$sel);
	@$num = mysqli_num_rows($res);
	
	if($num<0)
	{
		return 0;
	}
	else
	{
		@$rw = mysqli_fetch_array($res);
		$userid = $rw["userid"];
		$xid = $rw["id"];
		$data = htmlspecialchars_decode($rw["data"]);
		
		$dt = explode("|",$data);
			
		if($type=="" || $type=="URL")
		{
			return $dt[0];
		}
		elseif($type=="TITLE")
		{
			return $dt[1];
		}
		elseif($type=="ALT")
		{
			return $dt[2];
		}
		elseif($type=="ID")
		{
			return $xid;
		}
		elseif($type=="USERID")
		{
			return $userid;
		}
	}
}


function ImagesDetails($userid,$type){

	$sel = "SELECT * FROM meta WHERE meta_data = '".md5($type." MY HOME PAGE SLIDER IMAGE DETAILS")."' AND userid = '".md5($userid)."';";
	$res = mysqli_query($db,$sel);
	@$rw = mysqli_fetch_array($res);
	$data = $rw["data"];
	
	return 	$data;
}


function ListSliderImages(){

	$sel = "SELECT * FROM meta WHERE meta_data = '".md5("MY HOME PAGE SLIDER")."';";
	$res = mysqli_query($db,$sel);
	$num = mysqli_num_rows();
	for($a=0; $a<$num; $a++)
	{
	@$rw = mysqli_fetch_array($res);
	$id = $rw["id"];
	$userid = $rw["userid"];
	$data = $rw["data"];
	
	$array[] = array('id'=>$id,'userid'=>$userid,'img'=>getSliderImages($userid),'text'=>ImagesDetails($id,"TEXT"),'url'=>ImagesDetails($id,"URL"),'textline_height'=>ImagesDetails($id,"textline_height"),'textwidth'=>ImagesDetails($id,"textwidth"),'textheight'=>ImagesDetails($id,"textheight"),'v_orientation'=>ImagesDetails($id,"v_orientation"),'h_orientation'=>ImagesDetails($id,"h_orientation"),'v_orientation_value'=>ImagesDetails($id,"v_orientation_value"),'h_orientation_value'=>ImagesDetails($id,"h_orientation_value"),'h_orientation'=>ImagesDetails($id,"h_orientation"),'h_orientation'=>ImagesDetails($id,"h_orientation"),'fontsize'=>ImagesDetails($id,"fontsize"),'fontcolor'=>ImagesDetails($id,"fontcolor"));
	}

	return 	$array;
}


function CountSliderImages(){

	$sel = "SELECT count(id) AS maxCount FROM meta WHERE meta_data = '".md5("MY HOME PAGE SLIDER")."';";
	$res = mysqli_query($db,$sel);
	@$rw = mysqli_fetch_array($res);
	$maxCount = $rw["maxCount"];
	
	return 	$maxCount;
}


function addSliderImage($image,$title,$alt){
	
	$classx = $class." ";
	
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
	$cccA = md5($timex." || ".$sess_id." || ".$sess_id2." || ".$sess_id3." || ".$title." || ".$alt." || ".$image." || ");
	
	$array = htmlspecialchars($image."|".$title."|".$alt);
	
	$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccA."','".$image."','".md5("MY HOME PAGE SLIDER")."');";
	$res = mysqli_query($db,$ins);
	if($res)
	{
		$ins2 = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$cccA."','".mysqli_real_escape_string($db,$array)."','".md5("HOME PAGE SLIDER IMAGE")."');";
		$res2 = mysqli_query($db,$ins2);
		
		if($res2)
		{
			return 1;
		}
		else
		{
			return 1;
		}
	}
	else
	{
		return 0;
	}
}


function deleteSliderImage($id){
	
	$delete = "DELETE FROM meta WHERE userid = '".$id."';";
	$res = mysqli_query($db,$delete);
	
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}


function addImageDetails($type,$userid,$value){

	$ins = "INSERT INTO meta (id,userid,data,meta_data) VALUES ('','".$userid."','".$value."','".md5($type." MY HOME PAGE SLIDER IMAGE DETAILS")."');";
	$res = mysqli_query($db,$ins);
	if($res)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

?>