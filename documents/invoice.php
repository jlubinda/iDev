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


if(isset($_SESSION['cart']) && count($_SESSION['cart'])>=1)
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
$pdf->SetTitle('INVOICE - '.strtoupper($value["MerchantID"]).' '.date("d-m-Y"));
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
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<th align="left" bgcolor="#cccccc" style="margin:5px; float:left; width:350px;">
			<table style="margin:5px; float:left;">
				<tr>
					<td width="120"><img src="images/logo.png" width="120" ></td>
					<td style="margin:5px; float:left; width:250px;"><br><span style="font-size:20px;">City Drive Rent A Car</span><br><span style="font-size:11px;">Beyond the Ordinary...</span>
					</td>
				</tr>
			</table>
		</th>
		<th align="right" bgcolor="#cccccc" style="font-size:12px; width:280px;"><span style="font-size:30px;">INVOICE</span><br>INV'.strtoupper($_SESSION["uniqueCode2"]).'<br><strong>DATE:</strong> '.date("d-m-Y").'</th>
	</tr>
	<tr>
		<td align="left" cellpadding="4">Plot no 6075/1 Chisokone Road, Northmead Lusaka Zambia<br>
Phone;+260-961 303910/+260-976760159<br>
reservations@citydriverentacar.com</td>
		<td align="right" cellpadding="4">Beneficiary: CITY DRIVE RENT A CAR LTD<br>
Bank Name; STANBIC BANK<br>
Bank Address; Arcades Shopping Mall<br>
Great East Road<br>
P O Box 31955<br>
Lusaka, Zambia<br>
Account Number: 9130003640225<br>
Swift Code: SBICZMLX<br>
Branch Name; ARCADES BRANCH<br>
Branch Code: 040010</td>
	</tr></table><br><br>
	
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<td align="left" cellpadding="4">To:'.$_SESSION['CustomeName'].'         <br />        '.$_SESSION['CustomerEmail'].'</td>
		<td align="right" cellpadding="4">TPIN No.1001978753</td>
	</tr></table><br><br>
	
	
<table cellspacing="3" cellpadding="4" style="border: 1px solid #000;">
	<tr>
		<td><b>JOB</b></td>
		<td><b>PAYMENT TERMS</b></td>
		<td><b>DUE DATE</b></td>
	</tr>
	<tr>
		<td>VEHICLE HIRE</td>
		<td>50% DOWN PAYMENT UP-FRONT, 50% BALANCE UPON HIRE</td>
		<td>UPON HIRE</td>
	</tr>
</table><br><br>
	
<table cellspacing="3" cellpadding="4" bgcolor="#cccccc">
	<tr>
		<td width="80"><b>QTY</b></td>
		<td width="260"><b>DESCRIPTION</b></td>
		<td width="130"><b>UNIT PRICE</b></td>
		<td><b>LINE TOTAL</b></td>
	</tr>';
	
	
	$value = end ($_SESSION['cart']); 
	$i = 0;
	$currency = "USD";
	$totalValue = 0;
	while ($value) 
	{
		if($value["currency"]=="")
		{
			$currency = $currency;
		}
		else
		{
			$currency = $value["currency"];
		}
		
	$html .= '<tr bgcolor="#ffffff">
		<td>'.$value["duration"].' days</td>
		<td>'.$value["qty"].' x '.$value["name"].'</td>
		<td>'.$value["currency"].' '.(@number_format($value["price"],2)).'</td>
		<td>'.$value["currency"].' '.(@number_format(($value["price"]*$value["duration"]*$value["qty"]),2)).'</td>
	</tr>';
	
	if($value["oneway_rental_fee"]>0)
	{
	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td>ONE WAY RENTAL FEE</td>
		<td></td>
		<td>'.$value["currency"].' '.(@number_format(($value["oneway_rental_fee"]*$value["qty"]),2)).'</td>
	</tr>';
	}
	
	if($value["mileage_charge"]>0)
	{
	$html .= '<tr bgcolor="#ffffff">
		<td>'.$value["distance"].' km</td>
		<td>MILEAGE</td>
		<td>'.$value["currency"].' '.(@number_format($value["mileage_rate"],2)).'</td>
		<td>'.$value["currency"].' '.(@number_format(($value["mileage_charge"]*$value["qty"]),2)).'</td>
	</tr>';
	}
	
	if($value["chauffeur"]>0)
	{
	$html .= '<tr bgcolor="#ffffff">
		<td>'.$value["duration"].' days</td>
		<td>CHAUFFEUR</td>
		<td>'.$value["currency"].' '.(@number_format($value["chauffeur_rate"],2)).'</td>
		<td>'.$value["currency"].' '.(@number_format(($value["chauffeur"]*$value["qty"]),2)).'</td>
	</tr>';
	}
	
	$html .= '<tr bgcolor="#ffffff"><td></td>
		<td></td>
		<td><b>ITEM TOTAL</b></td>
		<td>'.$value["currency"].' '.(@number_format((($value["price"]*$value["duration"]*$value["qty"])+($value["chauffeur"]*$value["qty"])+($value["mileage_charge"]*$value["qty"])+($value["oneway_rental_fee"]*$value["qty"])),2)).'</td>
	</tr>';
	$totalValue = $totalValue+(($value["price"]*$value["duration"]*$value["qty"])+($value["chauffeur"]*$value["qty"])+($value["mileage_charge"]*$value["qty"])+($value["oneway_rental_fee"]*$value["qty"]));
	$value = prev($_SESSION['cart']); 
	$i=$i+1;
	}
	
	$html .= '<tr bgcolor="#ffffff"><td></td>
		<td></td>
		<td bgcolor="#cccccc"><b>SUB TOTAL</b></td>
		<td bgcolor="#cccccc">'.$currency.' '.(@number_format($totalValue,2)).'</td>
	</tr>';
	
	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td><b>INCLUDED:</b> COMPREHENSIVE INSURANCE, VEHICLE GIVEN WITH FULL TANK & RETURNED WITH FULL TANK</td>
		<td></td>
		<td></td>
	</tr>';

	$html .= '<tr bgcolor="#ffffff">
		<td></td>
		<td></td>
		<td>'.$vat.'%</td>
		<td>'.$currency.' '.(@number_format(($totalValue*$vatd/100),2)).'</td>
	</tr>';
	
	$html .= '<tr bgcolor="#cccccc">
		<td></td>
		<td></td>
		<td><b>TOTAL</b></td>
		<td>'.$currency.' '.(@number_format(($totalValue+(($totalValue*$vatd/100))),2)).'</td>
	</tr>';
	
$html .= '</table><br><br>';

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table

email('INVOICE NO. INV'.strtoupper($_SESSION["uniqueCode2"]),$html,"info@citydriverentacar.com",$_SESSION['CustomerEmail'],"reservations@citydriverentacar.com");
//email($subject,$message,$from,$to,$cc="",$bc="")
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('INVOICE - '.$_SESSION['CustomerEmail'].' '.date("d-m-Y").'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

	
}
else
{
	echo "ERROR!";
}