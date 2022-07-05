<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
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
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

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
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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

// set font
$pdf->setFont('times', 'BI', 12);

// add a page
$pdf->AddPage();

// set some text to print
$txt = <<<EOD
TCPDF Example 003
<h3 class="center">LOAN APPLICATION FORM</h3>

<h4 text-align="center"> CUSTOMERS PERSONAL INFORMATION</h4>
<p><b>Applicants Name:</b> Mr/Mrs/Miss :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Daniel Ouma Onyore  </p>
<br>
<p><b>Trading As:</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Single Business    </p>
<br>
<p><b>Marital Status: </b>   Single     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       <b>NATIONAL ID NO:</b>   34263696      </p>                             
<br>
<p><b>Tel: </b>   0712315075 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Mobile</b>   0712315075 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <b> Email:</b>   onyoredaniel@gmail.com      </p>  
<p><b>Current Address: </b>    334408-0600  Nairobi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Street</b> Kasarani Mwiki  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <b>House No</b> 2345     </p> 

<br><br>
<h4>BUSINESS DETAILS</h4>
<p><b> Nature of Business:</b><br><br><br> </br></br></br>   </p>
b><p><b>Physical Address: </b> (Attach Sketch) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Town</b> Kasarani Mwiki  &nbsp;&nbsp;     <b>Bulding No</b> 2345   &nbsp;&nbsp;   <b>Street</b>  </p> 
<br><br><br> </br></br></br>
<h4>LOAN PARTICULARS </h4>
<p><b>Amount Applied For: (Kshs)</b> 345,000  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Purpose :</b> Business   </p>
<p> <b> Cost of Project: (Kshs) 1,450,678 </b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       <b>Own Contribution (Kshs)</b> 560,000 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Monthly Repayment</b> 	12 months </p>
<br><br><br> </br></br></br>
<h4> LOAN IN OTHER INSTITUTION</h4>
<table>
  <tr>
    <th><b>Intitution</b></th>
    <th><b>Amount Advanced (Ksh)</b></th>
    <th><b>Date Advanced</b></th>
	<th><b>Repayment Period</b></th>
	<th><b>Outstanding Amount </b> (Ksh)</th>
  </tr>
  <tr>
    <td>Afrika Bank Limited</td>
    <td>340,000</td>
	<td>13/02/2022</td>
    <td>12 months</td>
	<td>180,000</td>
  </tr>
  
</table>

<p>
Attach bank Statement <br/>
Agency Name (If Applicable)
</p>
EOD;

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
