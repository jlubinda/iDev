<?php

//function defination to convert array to xml

if(function_exists("array_to_xml"))
{
	
}
else
{
	function array_to_xml($array, &$xml_user_info) {
		foreach($array as $key => $value) {
			if(is_array($value)) {
				if(!is_numeric($key)){
					$subnode = $xml_user_info->addChild("$key");
					array_to_xml($value, $subnode);
				}else{
					$subnode = $xml_user_info->addChild("item$key");
					array_to_xml($value, $subnode);
				}
			}else {
				$xml_user_info->addChild("$key",htmlspecialchars("$value"));
			}
		}
	}
}




function myArrayToXML($array){

	/**/
	$xml = '<?xml version="1.0" encoding="utf-8"?>';
	
	//$xml = "";
	
	$xml .= "\n";

	while ( $layer = each($array)) 
	{
	
		$xml .= "<".$layer["key"].">";
		$xml .= "\n";
		
		if(is_array($layer["value"]))
		{
			while ( $row = each($layer["value"])) 
			{ 
				$xml .= "<".$row["key"].">";
				
				if(is_array($row["value"]))
				{
					while ( $column = each($row["value"])) 
					{
						$xml .= "<".$column["key"].">";
						
						if(is_array($column["value"]))
						{
							while ( $a = each($column["value"])) 
							{
								$xml .= "<".$a["key"].">";
								
								if(is_array($a["value"]))
								{
									while ( $b = each($a["value"])) 
									{
										$xml .= "<".$b["key"].">";
										
										if(is_array($b["value"]))
										{
											while ( $c = each($b["value"])) 
											{
												$xml .= "<".$c["key"].">";
												
												if(is_array($c["value"]))
												{
													while ( $d = each($c["value"])) 
													{
														$xml .= "<".$d["key"].">";
														
														$xml .= $d["value"];
														
														$xml .= "</".$d["key"].">";
													}
												}
												else
												{
													$xml .= $c["value"];
												}
												
												$xml .= "</".$c["key"].">";
											}
										}
										else
										{
											$xml .= $b["value"];
										}
										
										$xml .= "</".$b["key"].">";
									}
								}
								else
								{
									$xml .= $a["value"];
								}
								
								$xml .= "</".$a["key"].">";
							}
						}
						else
						{
							$xml .= $column["value"];
						}
						
						$xml .= "</".$column["key"].">";
					}
				}
				else
				{
					$xml .= $row["value"];
				}
				$xml .= "</".$row["key"].">";
			}
		}
		else
		{
			$xml .= $layer["value"];
		}
	$xml .= "\n";
		$xml .= "</".$layer["key"].">";
	}
	return $xml;
}


class XmlElement {
	var $name;
	var $attributes;
	var $content;
	var $children;
};

function xml_to_object($xml){
	
	$parser = xml_parser_create();
	
	xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
	xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
	xml_parse_into_struct($parser,$xml,$tags);
	xml_parser_free($parser);
	
	$elements = array();
	$stack = array();
	
	foreach($tags as $tag)
	{
		$index = count($elements);
		
		if($tag['type']=="complete" || $tag['type']=="open")
		{
			$elements[$index] = new XmlElement;
			$elements[$index]->name = $tag['tag'];
			$elements[$index]->attributes = $tag['attributes'];
			$elements[$index]->content = $tag['value'];
			
			if($tag['type']=="open")
			{
				$elements[$index]->children = array();
				$stack[count($stack)] = &$elements;
				$elements = &$elements[$index]->children;
			}
		}
		
		if($tag['type']=="close")
		{
			$elements = &$stack[count($stack)-1];
			unset($stack[count($stack)-1]);
		}
	}
	
	return $elements[0];
}


function setArrayValue(&$array,$stack,$value){
	
	if($stack)
	{
		$key = array_shift($stack);
		setArrayValue($array[$key],$stack,$value);
		return $array;
	}
	else
	{
		$array = $value;
	}
}


function XMLToArray($xml){
	
	$parser = xml_parser_create("ISO-8859-1");
	
	xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
	xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
	xml_parse_into_struct($parser,$xml,$tags);
	xml_parser_free($parser);
	
	$elements = array();
	$stack = array();
	foreach($tags as $tag)
	{		
		if($tag['type']=="open")
		{
			array_push($stack,$tag['tag']);
		}
		elseif($tag['type']=="close")
		{
			array_pop($stack);
		}
		elseif($tag['type']=="complete")
		{
			array_push($stack,$tag['tag']);
			setArrayValue($elements,$stack,$tag['value']);
			array_pop($stack);
		}
	}
	
	return $elements;
}


//creating object of SimpleXMLElement
/*$xml_user_info = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><API3G></API3G>");*/
					
					
//function call to convert array to xml
//array_to_xml($users_array,$xml_user_info);

//saving generated xml file
//$xml_file = $xml_user_info->asXML();
//$xml_file = myArrayToXML($users_array);


//success and error message based on xml creation
//if($xml_file){
//    print ($xml_file);
//}
//else
//{
//    echo 'XML file generation error.';
//}

?>
