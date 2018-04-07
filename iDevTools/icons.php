<?php

		if($filetype=="jpg" || $filetype=="png" || $filetype=="gif" || $filetype=="tiff" || $filetype=="jpeg" || $filetype=="ico" || $filetype=="jpe" || $filetype=="png" || $filetype=="ai" || $filetype=="psd" || $filetype=="bmp" || $filetype=="wbmp")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
			$fileunzipable = "No";
			}
			else
			{
		$icon = "png.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="exe" || $filetype=="msi")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
			$fileunzipable = "No";
			}
			else
			{
		$icon = "exe.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="bat" || $filetype=="cmd")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
			$fileunzipable = "No";
			}
			else
			{
		$icon = "bat.png";
		$filedownloadable = "Yes";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="css")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
			$fileunzipable = "No";
			}
			else
			{
		$icon = "txt2.png";
		$filedownloadable = "No";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="crt")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
			$fileunzipable = "No";
			}
			else
			{
		$icon = "crt.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="dll" || $filetype=="com")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
			$fileunzipable = "No";
			}
			else
			{
		$icon = "dll.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="odt" || $filetype=="ott" || $filetype=="sxw" || $filetype=="stw" || $filetype=="fodt" || $filetype=="doc" || $filetype=="rtf" || $filetype=="docx")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "doc.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
			$icon = "unknown.png";
			$filedownloadable = "Yes";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="html" || $filetype=="htm")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "html.png";
		$filedownloadable = "No";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="js")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "js.png";
		$filedownloadable = "No";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="vbs")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "vbs.png";
		$filedownloadable = "Yes";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="wav" || $filetype=="bwf" || $filetype=="mp3" || $filetype=="aif" || $filetype=="aifc" || $filetype=="au" || $filetype=="avr" || $filetype=="caf" || $filetype=="flac" || $filetype=="htk" || $filetype=="iff" || $filetype=="mat" || $filetype=="mpc" || $filetype=="oga" || $filetype=="ogg" || $filetype=="paf" || $filetype=="pcm" || $filetype=="pvf" || $filetype=="raw" || $filetype=="rf64" || $filetype=="sd2" || $filetype=="sds" || $filetype=="sf" || $filetype=="snd" || $filetype=="voc" || $filetype=="vox" || $filetype=="w64" || $filetype=="wve" || $filetype=="xi" || $filetype=="wma" || $filetype=="wave")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "mp3.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="3g2" || $filetype=="3gp" || $filetype=="3gp2" || $filetype=="3gpp" || $filetype=="amv" || $filetype=="asf" || $filetype=="avi" || $_REQUEST["bin"]=="divx" || $filetype=="drc" || $filetype=="dv" || $filetype=="f4v" || $filetype=="flv" || $filetype=="gvi" || $filetype=="gxf" || $filetype=="m1v" || $filetype=="m2v" || $filetype=="m2t" || $filetype=="m2ts" || $filetype=="m4v" || $filetype=="mkv" || $filetype=="mov" || $filetype=="mp2" || $filetype=="mxg" || $filetype=="nsv" || $filetype=="nuv" || $filetype=="ogm" || $filetype=="ogv" || $filetype=="ogx" || $filetype=="ps" || $filetype=="rec" || $filetype=="rm" || $filetype=="rmvb" || $filetype=="tod" || $filetype=="ts" || $filetype=="tts" || $filetype=="vob" || $filetype=="vro" || $filetype=="webm" || $filetype=="wm" || $filetype=="wmv" || $filetype=="wtv" || $filetype=="xesc")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "mpeg.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="pdf")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "pdf.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="php")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "php.png";
		$filedownloadable = "No";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="txt")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "txt2.png";
		$filedownloadable = "Yes";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="ini")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "config.png";
		$filedownloadable = "Yes";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="ods" || $filetype=="ots" || $filetype=="sxc" || $filetype=="stc" || $filetype=="fods" || $filetype=="uos" || $filetype=="xlsx" || $filetype=="xls" || $filetype=="xls" || $filetype=="dif" || $filetype=="dbf" || $filetype=="slk" || $filetype=="csv")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "xls.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
		elseif($filetype=="zip" || $filetype=="rar" || $filetype=="cab" || $filetype=="arj" || $filetype=="lzh" || $filetype=="ace" || $filetype=="7-zip" || $filetype=="tar" || $filetype=="gzip" || $filetype=="uue" || $filetype=="bz2" || $filetype=="jar" || $filetype=="iso" || $filetype=="z")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "zip.png";
		$filedownloadable = "Yes";
		$fileeditable = "No";
		$fileunzipable = "Yes";
			}
		}
		elseif($filetype=="xml")
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
		$icon = "xml.png";
		$filedownloadable = "No";
		$fileeditable = "Yes";
		$fileunzipable = "No";
			}
		}
		else
		{
			if($file_dir=="folder")
			{
			$icon = "folder.png";
			$filedownloadable = "No";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
			else
			{
			$icon = "unknown.png";
			$filedownloadable = "Yes";
			$fileeditable = "No";
		$fileunzipable = "No";
			}
		}
?>