<?php
session_start();


if(function_exists('clean_my_email_string'))
{
	
}
else
{
	function clean_my_email_string($string) {
		$bad = array("content-type","bcc:","to:","cc:","href");
		return str_replace($bad,"",$string);
	}

}
 
 

if(function_exists('email'))
{
	
}
else
{
	function email($subject,$message,$from,$to,$cc="",$bc=""){

		$headers = "From: " . strip_tags($from) . "\r\n";
		$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
		$headers .= "CC: ". strip_tags($cc) . "\r\n";
		$headers .= "BCC: ". strip_tags($bc) . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		if(@mail($to, clean_my_email_string($subject), clean_my_email_string($message), $headers))
		{
			return 1;
		}
		else
		{
			return 0;
		}
			//////////////////////MAILER////////////////////////////////////////////
	}
}
 
 
if($value["vatpayable"]=="0" || $value["vatpayable"]=="" || !(isset($value["vatpayable"])))
{
	$vat = 'VAT @ '.$value["vat"];
	$vatd = 0;
}
else
{
	$vat = 'VAT @ '.$value["vat"];
	$vatd = $value["vat"];
}

$names = $_SESSION['CustomerName'];

if(isset($_SESSION['cart']) && count($_SESSION['cart'])>=1 && isset($_SESSION["ref_num"]))
{
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// include_once the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

/*
	names=<?php echo $first_name." ".$last_name;?>&qty=<?php echo $numDays;?>&price=<?php echo getActualPrice($value["id"],$value['fromcity'],$typed);?>&vtype=$vtype&mileage_charge=<?php echo $mileage_charge;?>&distance=<?php echo $distance;?>&driver_rate=<?php echo $driver_rate;?>
*/

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('www.PayItApp.co');
$pdf->SetTitle('RESERVATION CONFIRMATION LETTER FOR '.strtoupper($names).' - '.date("d-m-Y"));
$pdf->SetSubject('VEHICLE/ACCESSORIES RENTAL');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)


// output some RTL HTML content
// create some HTML content
$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

$html = '
<table cellspacing="3" cellpadding="4" align="center">
	<tr>
		<th align="center" bgcolor="#ffffff" style="margin:5px;">
			<table style="margin:5px;" align="center">
				<tr>
					<td width="120"><img src="images/logo.png" width="120" ></td>
					<td style="margin:5px;" align="center" width="550"><br><span style="font-size:40px;">City Drive Rent A Car</span><br><br><span style="font-size:30px;">Beyond the Ordinary...</span>
					</td>
				</tr>
			</table>
		</th>
	</tr>
</table>
<p align="center"><u><span style="font-size:25px;">CONFIRMED RESERVATION</span></u></p>
<br><br>	
<table cellspacing="3" cellpadding="4" >
	<tr>
		<td align="left" cellpadding="4"><b>To:</b> '.$names.'</td>
		<td align="right" cellpadding="4"><b>Date:</b> '.date("d-m-Y @ H:i").'hrs</td>
	</tr>
	<tr>
		<td align="left"><b>Reservation No:</b> '.strtoupper($_SESSION["uniqueCode2"]).'</td>
		<td align="right"><b>Method of Payment:</b> Online Payment</td>
	</tr>
</table>
	<p>Thank you for choosing City Drive Rent a Car. We are pleased to confirm the details of your reservation as follows:</p>
	<br><br>
	
<table cellspacing="3" cellpadding="4" bgcolor="#cccccc">';
	
	
	$value = end ($_SESSION['cart']); 
	$i = 0;
	$num = count($_SESSION['cart']);
	while ($value) 
	{
		
	$html .= '<tr bgcolor="#ffffff">
		<td><b>Start Date:</b>'.date("d-m-Y @ H:i",strtotime($value["pickUpDateTime"])).'hrs</td>
		<td><b>Qty x Product Type:</b>'.$value["qty"].' x '.$value["name"].'</td>
	</tr>';
		
	$html .= '<tr bgcolor="#ffffff">
		<td><b>End Date:</b>'.date("d-m-Y @ H:i",strtotime($value["DropOffDateTime"])).'hrs</td>
		<td><b>Chauffeur:</b>';
		
		if($value["chauffeur"]>0)
		{
			$html .= 'Yes';
		}
		else
		{
			$html .= 'No';
		}
		
		$html .= '</td>
	</tr>';
		
	$html .= '<tr bgcolor="#ffffff">
		<td><b>No of Adults:</b>'.$value["NoOfAdults"].'</td>
		<td><b>Pick up Place:</b>'.$value["pickUpArea"].'</td>
	</tr>';
		
	$html .= '<tr bgcolor="#ffffff">
		<td><b>No of Children:</b>'.$value["NoOfChildren"].'</td>
		<td><b>Drop off Place:</b>'.$value["DropOffTown"].'</td>
	</tr>';
	
		if(($num-1)==$i)
		{
			
		}
		else
		{
			$html .= '<tr>
				<td> </td>
				<td> </td>
			</tr>';
		}
	
	$value = prev($_SESSION['cart']); 
	$i=$i+1;
	}
$html .= '</table>';

	$html .= '<br><p>
	<b>Comments:</b><br><br>
A cancellation fee of 50% on the deposit paid will apply on all cancelled bookings.<br><br>
Deposit/Advanced Payment/Credit card details will be requested upon collection of vehicle.<br><br>
We look forward to welcoming you as City Drive Rent a car and wish you a pleasant and safe journey.</p>
<p>Yours Sincerely</p>
<p>City Drive Team</p>';
	

	$html .= '<br><br><p align="center" style="font-size:10px;">Plot 6075/1 Chisokonke Road Northmead off Great East Road.Postnet 137 Lusaka Zambia<br>
Tell; +260 211 295290 cell; +260-977482773,+260-966332422 Email;reservations@citydriverentacar.com<br>
Contact; Mulenga Bwalya (Marketing Executive) and Gregory Chama (Managing Director)</p>';

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

email("RESERVATION CONFIRMATION LETTER",$html,"reservations@citydriverentacar.com",$_SESSION['CustomerEmail']);

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('INVOICE - '.strtoupper($value["names"]).' '.date("d-m-Y").'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


	unset($_SESSION["token"]);
	unset($_SESSION["cart"]);
	unset($_SESSION["ref_num"]);
	unset($_SESSION['cartnum']);
	unset($_SESSION['CustomerName']);
	unset($_SESSION['uniqueCode']);
	unset($_SESSION['uniqueCode2']);
	unset($_SESSION['uniqueCode3']);	
}
else
{
	echo "ERROR!";
}