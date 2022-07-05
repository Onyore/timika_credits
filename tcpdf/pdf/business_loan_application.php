<?php
$id=$_REQUEST['id'];
$db_configs = require("../../env.php");
//database connection
$con=mysqli_connect($db_configs['db_host'], $db_configs['db_username'], $db_configs['db_password'],$db_configs['db_name']);
//mysqli_select_db($con,'gowns');

//SELECTING FROM BORROWERS TABLE
$query=mysqli_query($con,"SELECT * FROM borrowers where id=$id");
//echo $query;
$data=mysqli_fetch_array($query);
// print_r ($data);
$firstname=$data['firstname'];
$lastname=$data['lastname'];
$middlename=$data['middlename'];
$street=$data['street'];
$id_no=$data['id_no'];
$marital=$data['marital'];
$dob=$data['dob'];
$address=$data['address'];
$estate=$data['estate'];
$email=$data['email'];
$house_no=$data['house_no'];
$town=$data['town'];
$contact_no=$data['contact_no'];
$bus_name=$data['bus_name'];
$bus_town=$data['bus_town'];
$bus_street=$data['bus_street'];

//SELECTING FROM LOAN LIST TABLE
$query=mysqli_query($con,"SELECT * FROM `loan_list` ORDER BY borrower_id;");
//echo $query;
$row=mysqli_fetch_array($query);
$amount=$row['amount'];
$purpose=$row['purpose'];
$ref_no=$row['ref_no'];
$date_created=$row['date_created'];

// print_r ($row);

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'logo.jpg';
		$this->Image($image_file, 40, 6, 85, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->setFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, ' ', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->setY(-15);
		// Set font
		$this->setFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'TRV Towers, Ngara Rd, 8th Floor Wing 8A P.O BOX 7444 – 00100 Nairobi. TEL: 0714900000 EMAIL: info@tamika.co.ke   Website: www.tamika.co.ke', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 003');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('times', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD

<p style="text-align: center;"><span style="font-family: 'times new roman', times; font-size: small;"><strong>BUSINESS LOAN APPLICATION FORM &ndash; INDIVIDUAL</strong></span></p>
<p style="text-align: right;"><span style="font-size: xx-small;"><strong style="font-family: 'times new roman', times; font-size: small;">FOR OFFICIAL USE ONLY</strong></span>
<br />
<span style="font-family: 'times new roman', times; font-size: xx-small;">Loan A/c No. $ref_no</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Date:$date_created</span></p>

<p><span style="font-size: xx-small;"><strong style="font-family: 'times new roman', times; font-size: small;">HEAD OFFICE</strong></span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">P.O. BOX 7444-00100.</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Nairobi</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;TRV Towers, 8th floor, Wing 8A</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Tel: 071490000</span></p>
<p style="text-align: center;"><span style="font-size: xx-small;"><strong style="font-family: 'times new roman', times; font-size: small;"><span style="font-family: 'times new roman', times;">CUSTOMERS PERSONAL INFORMATION</span></strong></span></p>
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Applicants Name: MR/MRS/MISS:$firstname &nbsp;&nbsp;&nbsp;&nbsp; $middlename &nbsp;&nbsp;&nbsp;&nbsp; $lastname</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Trading As:&nbsp;&nbsp;</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">National Id No: $id_no &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><br />
<span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;Marital Status: $marital &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Of Birth: $dob </span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Postal Address: $address </span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Permanent Address : $address</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Tel:&nbsp; Landline: $contact_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Mobile : $contact_no&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Email:$email</span>
<br />
<span style="font-family: 'times new roman', times; font-size: xx-small;">Residence: Town $town &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estate : $estate &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><br />
<span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;House Number: $house_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Street: $street &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></p>
<p style="text-align: center;"><span style="font-size: xx-small;"><span style="font-family: 'times new roman', times;">&nbsp; &nbsp; &nbsp; </span><strong style="font-family: 'times new roman', times; font-size: small;"><span style="font-family: 'times new roman', times;">BUSINESS DETAILS</span></strong></span></p>

<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Nature Of Business: Physical Address: (Attach Sketch)</span><br /><span style="font-family: 'times new roman', times; font-size: xx-small;">Town:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Building No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Street:</span></p>
<p align="center"><span style="font-family: 'times new roman', times; font-size: xx-small;"><strong>LOAN PARTICULARS</strong></span></p>
<p><span style="font-size: xx-small;"><span style="font-family: 'times new roman', times;">&nbsp;Amount Applied For: $amount (Kshs) &nbsp;&nbsp;&nbsp;&nbsp;(</span><em style="font-family: 'times new roman', times; font-size: small;">in words</em><span style="font-family: 'times new roman', times;">)</span></span><br />
<span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;Purpose :$purpose</span><br /><span style="font-size: xx-small;"><span style="font-family: 'times new roman', times;">Cost of Project: (Kshs) &nbsp;&nbsp;&nbsp;(</span><em style="font-family: 'times new roman', times; font-size: small;">in words</em><span style="font-family: 'times new roman', times;">)&nbsp; &nbsp; &nbsp;&nbsp;</span></span><br />
<span style="font-size: xx-small;"><span style="font-family: 'times new roman', times;">Own Contribution (Kshs) (</span><em style="font-family: 'times new roman', times; font-size: small;">in words</em><span style="font-family: 'times new roman', times;">)</span></span><br />
<span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;Monthly Repayment:</span></p>
<p align="center"><span style="font-family: 'times new roman', times; font-size: xx-small;"><strong>LOAN IN OTHER INSTITUTION</strong></span></p>
<table style="width: 630px; height: 126px;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="195">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Institution</span></p>
</td>
<td valign="top" width="130">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Amount Advanced</span></p>
</td>
<td valign="top" width="101">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Date Advanced</span></p>
</td>
<td valign="top" width="94">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Repayment Period</span></p>
</td>
<td valign="top" width="93">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Outstanding Amount</span></p>
</td>
</tr>
<tr>
<td valign="top" width="195">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="130">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="101">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="94">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="93">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td valign="top" width="195">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="130">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="101">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="94">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="93">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td valign="top" width="195">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="130">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="101">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="94">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="93">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td valign="top" width="195">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">(Attach bank Statements)</span></p>
</td>
<td valign="top" width="130">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="101">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="94">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="93">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td valign="top" width="195">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">Agency Name (if Applicable)</span></p>
</td>
<td valign="top" width="130">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="101">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="94">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="93">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><span style="font-size: xx-small;"><strong style="font-family: 'times new roman', times; font-size: small;">SECURITY</strong></span></p>
<table style="width: 632px; height: 70px;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="188">
<p><span style="font-size: xx-small;">Type</span></p>
</td>
<td valign="top" width="132">
<p><span style="font-size: xx-small;">Details</span></p>
</td>
<td valign="top" width="103">
<p><span style="font-size: xx-small;">Estimate Value</span></p>
</td>
<td valign="top" width="96">
<p><span style="font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="64">
<p><span style="font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td valign="top" width="188">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="132">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="103">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="96">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="64">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td valign="top" width="188">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="132">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="103">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="96">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="64">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td valign="top" width="188">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;"><strong>(Attach Copies of Securities)</strong></span></p>
</td>
<td valign="top" width="132">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="103">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="96">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
<td valign="top" width="64">
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>
<p align="center"><span style="font-size: xx-small;"><span style="font-family: 'times new roman', times;"><strong>&nbsp;</strong></span><strong style="font-family: 'times new roman', times; font-size: small;">DECLARATION</strong></span></p>
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">I/WE declare that the Information given herein is true of my/our knowledge and belief. I/we further authorize the lender to verify the information given herein and make reference from any person(s) including credit reference bureaus.</span></p>
<p><span style="font-family: 'times new roman', times; font-size: xx-small;">&nbsp;Signature of Applicant_________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date __________________________</span></p>

EOD;



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Timika Loan Application', 'I');

//============================================================+
// END OF FILE
//============================================================+
