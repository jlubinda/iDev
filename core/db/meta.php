<?php 

if(function_exists('addMeta'))
{
	
}
else
{

	function addMeta($meta_data,$userid="",$data="",$numdata=0,$syncstate="",$r_user="",$datedata=""){
		
		if($_REQUEST["cnct"]=="")
		{
			include find_file("cnct.php");
		}
		else
		{
			include find_file($_REQUEST["cnct"]);
		}
		
		
		$ins = "INSERT INTO meta (id,userid,data,numdata,datedata,meta_data,syncstate,r_user) VALUES ('','".$userid."','".$data."','".$numdata."','".$datedata."','".md5($meta_data)."','".$syncstate."','".$r_user."');";
		$res = mysqli_query($db,$ins);
		
		//echo $ins."<br>";
		
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}


if(function_exists('getMeta'))
{
	
}
else
{

	function getMeta($meta_data,$id="",$userid="",$data="",$numdata="",$syncstate="",$r_user="",$datedata="",$misc="",$limiter=""){
		
		
		if($_REQUEST["cnct"]=="")
		{
			include find_file("cnct.php");
		}
		else
		{
			include find_file($_REQUEST["cnct"]);
		}
		
		$idx = explode("|",$id);
		$idOp = $idx[0];
		$idData = $idx[1];
		$idFunc = $idx[2];
		$idAs = $idx[3];
		
		$useridx = explode("|",$userid);
		$useridOp = $useridx[0];
		$useridData = $useridx[1];
		$useridFunc = $useridx[2];
		$useridAs = $useridx[3];
		
		$datax = explode("|",$data);
		$dataOp = $datax[0];
		$dataData = $datax[1];
		$dataFunc = $datax[2];
		$dataAs = $datax[3];
		
		$numdatax = explode("|",$numdata);
		$numdataOp = $numdatax[0];
		$numdataData = $numdatax[1];
		$numdataFunc = $numdatax[2];
		$numdataAs = $numdatax[3];
		
		$syncstatex = explode("|",$syncstate);
		$syncstateOp = $syncstatex[0];
		$syncstateData = $syncstatex[1];
		$syncstateFunc = $syncstatex[2];
		$syncstateAs = $syncstatex[3];
		
		$r_userx = explode("|",$r_user);
		$r_userOp = $r_userx[0];
		$r_userData = $r_userx[1];
		$r_userFunc = $r_userx[2];
		$r_userAs = $r_userx[3];
		
		$datedatax = explode("|",$datedata);
		$datedataOp = $datedatax[0];
		$datedataData = $datedatax[1];
		$datedataFunc = $datedatax[2];
		$datedataAs = $datedatax[3];
		
		if($idFunc=="")
		{
			$id_field = "id";
		}
		else
		{
			$id_field = $idFunc."(id) ".$idAs;
		}
		
		if($useridFunc=="")
		{
			$userid_field = "userid";
		}
		else
		{
			$userid_field = $useridFunc."(userid) ".$useridAs;
		}

		
		if($dataFunc=="")
		{
			$data_field = "data";
		}
		else
		{
			$data_field = $dataFunc."(data) ".$dataAs;
		}
		
		
		if($numdataFunc=="")
		{
			$numdata_field = "numdata";
		}
		else
		{
			$numdata_field = $numdataFunc."(numdata) ".$numdataAs;
		}
		
		
		if($syncstateFunc=="")
		{
			$syncstate_field = "syncstate";
		}
		else
		{
			$syncstate_field = $syncstateFunc."(syncstate) ".$syncstateAs;
		}
		
		
		if($r_userFunc=="")
		{
			$r_user_field = "r_user";
		}
		else
		{
			$r_user_field = $r_userFunc."(r_user) ".$r_userAs;
		}
		
		
		if($datedataFunc=="")
		{
			$datedata_field = "datedata";
		}
		else
		{
			$datedata_field = $datedataFunc."(datedata)";
		}
		
		$where = "";
		$w = 0;
		if(!($meta_data=="NIL"))
		{
			$w = $w+1;
			$where .= "WHERE meta_data = '".md5($meta_data)."'";
		}
		
		if(!($idOp==""))
		{		
			if($w==0)
			{
				$and = "WHERE";
			}
			else
			{
				$and = "AND";
			}
			
			$w = $w+1;
			$where .= " ".$and." id ".$idOp." (".$idData.")";
		}
		
		if(!($useridOp==""))
		{	
			if($w==0)
			{
				$and = "WHERE";
			}
			else
			{
				$and = "AND";
			}
			$w = $w+1;
			$where .= " ".$and." userid ".$useridOp." (".$useridData.")";
		}
		
		if(!($dataOp==""))
		{	
			if($w==0)
			{
				$and = "WHERE";
			}
			else
			{
				$and = "AND";
			}
			$w = $w+1;
			$where .= " ".$and." data ".$dataOp." (".$dataData.")";
		}
		
		//$syncstate="",$r_user="",$datedata=""
		if(!($numdataOp==""))
		{	
			if($w==0)
			{
				$and = "WHERE";
			}
			else
			{
				$and = "AND";
			}
			$w = $w+1;
			$where .= " ".$and." numdata ".$numdataOp." (".$numdataData.")";
		}
		
		if(!($syncstateOp==""))
		{	
			if($w==0)
			{
				$and = "WHERE";
			}
			else
			{
				$and = "AND";
			}
			$w = $w+1;
			$where .= " ".$and." syncstate ".$syncstateOp." (".$syncstateData.")";
		}
		
		if(!($r_userOp==""))
		{	
			if($w==0)
			{
				$and = "WHERE";
			}
			else
			{
				$and = "AND";
			}
			$w = $w+1;
			$where .= " ".$and." r_user ".$r_userOp." (".$r_userData.")";
		}
		
		if(!($datedataOp==""))
		{	
			if($w==0)
			{
				$and = "WHERE";
			}
			else
			{
				$and = "AND";
			}
			$w = $w+1;
			$where .= " ".$and." datedata ".$datedataOp." (".$datedataData.")";
		}
		
		$sel = "SELECT ".$id_field.",".$userid_field.",".$data_field.",".$numdata_field.",".$datedata_field.",meta_data,".$syncstate_field.",".$r_user_field.",val ".$misc." FROM meta ".$where." ".$limiter.";";
		$res = mysqli_query($db,$sel);
		@$num = mysqli_num_rows($res);
		
		//echo $sel."<br><br>";
		//echo $num."<br><br>";
		
		if($num<=0)
		{
			return 0;
		}
		elseif($num>=1)
		{
			for($a=0; $a<$num; $a++)
			{
				@$rw = mysqli_fetch_array($res);
				$miscRes1 = $rw['misc1'];
				$miscRes2 = $rw['misc2'];
				$miscRes3 = $rw['misc3'];
				$miscRes4 = $rw['misc4'];
				$miscRes5 = $rw['misc5'];
				$miscRes6 = $rw['misc6'];
				$miscRes7 = $rw['misc7'];
				
				$array[] = array('id'=>$rw['id'],'userid'=>$rw['userid'],'data'=>$rw['data'],'numdata'=>$rw['numdata'],'datedata'=>$rw['datedata'],'meta_data'=>$rw['meta_data'],'syncstate'=>$rw['syncstate'],'r_user'=>$rw['r_user'],'num'=>$num,'val'=>$rw['val'],'misc1'=>$miscRes1,'misc2'=>$miscRes2,'misc3'=>$miscRes3,'misc4'=>$miscRes4,'misc5'=>$miscRes5,'misc6'=>$miscRes6,'misc7'=>$miscRes7);
			}
			
			//echo "test3: ".$rw['data']."<br><br>";
			
			return $array;
		}/*
		elseif($num==1)
		{
				@$rw = mysqli_fetch_array($res);
				$miscRes1 = $rw['misc1'];
				$miscRes2 = $rw['misc2'];
				$miscRes3 = $rw['misc3'];
				$miscRes4 = $rw['misc4'];
				$miscRes5 = $rw['misc5'];
				$miscRes6 = $rw['misc6'];
				$miscRes7 = $rw['misc7'];
				
				$array = array('id'=>$rw['id'],'userid'=>$rw['userid'],'data'=>$rw['data'],'numdata'=>$rw['numdata'],'datedata'=>$rw['datedata'],'meta_data'=>$rw['meta_data'],'syncstate'=>$rw['syncstate'],'r_user'=>$rw['r_user'],'num'=>$num,'val'=>$rw['val'],'misc1'=>$miscRes1,'misc2'=>$miscRes2,'misc3'=>$miscRes3,'misc4'=>$miscRes4,'misc5'=>$miscRes5,'misc6'=>$miscRes6,'misc7'=>$miscRes7);
			
			return $array;
		}*/
		
		mysqli_close($db);
	}
}


if(function_exists('deleteMeta'))
{
	
}
else
{
	function deleteMeta($meta_data,$id="",$userid="",$data="",$numdata="",$syncstate="",$r_user="",$datedata=""){
		
		
		if($_REQUEST["cnct"]=="")
		{
			include find_file("cnct.php");
		}
		else
		{
			include find_file($_REQUEST["cnct"]);
		}
		
		$idx = explode("|",$id);
		$idData = $idx[1];
		$idOp = $idx[0];
		
		$useridx = explode("|",$userid);
		$useridData = $useridx[1];
		$useridOp = $useridx[0];
		
		$datax = explode("|",$data);
		$dataData = $datax[1];
		$dataOp = $datax[0];
		
		$numdatax = explode("|",$numdata);
		$numdataData = $numdatax[1];
		$numdataOp = $numdatax[0];
		
		$syncstatex = explode("|",$syncstate);
		$syncstateData = $syncstatex[1];
		$syncstateOp = $syncstatex[0];
		
		$r_userx = explode("|",$r_user);
		$r_userData = $r_userx[1];
		$r_userOp = $r_userx[0];
		
		$datedatax = explode("|",$datedata);
		$datedataData = $datedatax[1];
		$datedataOp = $datedatax[0];
		
		$where = "";
		
		if(!($idOp==""))
		{		
			$where .= " ".$and." userid ".$idOp." (".$idData.")";
		}
		
		if(!($useridOp==""))
		{
			$where .= " ".$and." userid ".$useridOp." (".$useridData.")";
		}
		
		if(!($dataOp==""))
		{
			$where .= " ".$and." userid ".$dataOp." (".$dataData.")";
		}
		
		//$syncstate="",$r_user="",$datedata=""
		if(!($numdataOp==""))
		{
			$where .= " ".$and." userid ".$numdataOp." (".$numdataData.")";
		}
		
		if(!($syncstateOp==""))
		{
			$where .= " ".$and." userid ".$syncstateOp." (".$syncstateData.")";
		}
		
		if(!($r_userOp==""))
		{
			$where .= " ".$and." userid ".$r_userOp." (".$r_userData.")";
		}
		
		if(!($datedataOp==""))
		{
			$where .= " ".$and." userid ".$datedataOp." (".$datedataData.")";
		}
		
		$del = "DELETE FROM meta WHERE meta_data = '".md5($meta_data)."' ".$where.";";
		$res = mysqli_query($db,$del);
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}

}


if(function_exists('updateMeta'))
{
	
}
else
{

	function updateMeta($meta_data,$id="",$userid="",$data="",$numdata="",$syncstate="",$r_user="",$datedata=""){
		
		
		if($_REQUEST["cnct"]=="")
		{
			include find_file("cnct.php");
		}
		else
		{
			include find_file($_REQUEST["cnct"]);
		}
		
		$upd = "";
		
		if(!($userid==""))
		{
			$upd .= "userid = '".$userid."'";
		}
		
		if(!($data==""))
		{
			if($upd=="")
			{
				$upd .= "data = '".$data."'";
			}
			else
			{
				$upd .= ", data = '".$data."'";
			}
		}
		
		if(!($numdata==""))
		{
			if($upd=="")
			{
				$upd .= "numdata = '".$numdata."'";
			}
			else
			{
				$upd .= ", numdata = '".$numdata."'";
			}
		}
		
		if(!($syncstate==""))
		{
			if($upd=="")
			{
				$upd .= "syncstate = '".$syncstate."'";
			}
			else
			{
				$upd .= ", syncstate = '".$syncstate."'";
			}
		}
		
		if(!($r_user==""))
		{
			if($upd=="")
			{
				$upd .= "r_user = '".$r_user."'";
			}
			else
			{
				$upd .= ", r_user = '".$r_user."'";
			}
		}
		
		if(!($datedata==""))
		{
			if($upd=="")
			{
				$upd .= "datedata = '".$datedata."'";
			}
			else
			{
				$upd .= ", datedata = '".$datedata."'";
			}
		}
		
		$update = "UPDATE meta SET (".$upd.") WHERE meta_data = '".md5($meta_data)."' AND id = '".$id."';";
		$res = mysqli_query($db,$update);
		if($res)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
		mysqli_close($db);
	}
}
?>