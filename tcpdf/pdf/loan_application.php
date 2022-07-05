<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
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
 * @abstract TCPDF - Example: Default Header and Footer
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
		$this->Image($image_file, 50, 3, 85, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
		// $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('');
$pdf->setTitle('Offer Letter');
$pdf->setSubject('Timika Credits Limited');
$pdf->setKeywords('T');

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
<table style="width: 698px;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="30">
<p class="Style10"><strong>&nbsp;</strong></p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10"><strong>CUSTOMER&rsquo;S PERSONAL INFORMATION</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10">Applicant&rsquo;s Name (Mrs./Mrs./Miss</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10">Trading As:</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10">National ID/Passport No. (Attach Copy)</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p class="Style10">Marital Status</p>
</td>
<td valign="top" width="132">
<p class="Style10">Single</p>
</td>
<td valign="top" width="103">
<p class="Style10">Married</p>
</td>
<td valign="top" width="96">
<p class="Style10">Others</p>
</td>
<td valign="top" width="131">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p class="Style10">Date of Birth</p>
</td>
<td valign="top" width="132">
<p class="Style10">Single</p>
</td>
<td valign="top" width="103">
<p class="Style10">Married</p>
</td>
<td valign="top" width="96">
<p class="Style10">Others</p>
</td>
<td valign="top" width="131">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10">Postal Address Current</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10">Permanent Address</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p class="Style10">Tel: (Landline)</p>
</td>
<td colspan="2" valign="top" width="235">
<p class="Style10">Mobile</p>
</td>
<td colspan="2" valign="top" width="227">
<p class="Style10">Email:</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p class="Style10">Residence: Town</p>
</td>
<td colspan="2" valign="top" width="235">
<p class="Style10">Estate</p>
</td>
<td colspan="2" valign="top" width="227">
<p class="Style10">Estate</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p class="Style10">House No.</p>
</td>
<td colspan="2" valign="top" width="235">
<p class="Style10">Rented</p>
</td>
<td colspan="2" valign="top" width="227">
<p class="Style10">Owned</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10"><strong>&nbsp;</strong></p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10"><strong>BUSINESS DETAILS</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10">Nature of Business</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p class="Style10">Physical Address (Attach Sketch)</p>
</td>
<td colspan="2" valign="top" width="235">
<p class="Style10">Town</p>
</td>
<td colspan="2" valign="top" width="227">
<p class="Style10">Building</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10">Street&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. of Years in this Business</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p class="Style10"><strong>LOAN PARTICULARS</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="3" valign="top" width="440">
<p class="Style10">Amount applied for (Kshs)</p>
</td>
<td valign="top" width="96">
<p class="Style10">Purpose</p>
</td>
<td valign="top" width="131">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="3" valign="top" width="440">
<p class="Style10">Cost of Project (Kshs)</p>
</td>
<td colspan="2" valign="top" width="227">
<p class="Style10">Own Contribution (Kshs)</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="3" valign="top" width="440">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="2" valign="top" width="227">
<p class="Style10">Monthly Repayments (Kshs)</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="4" valign="top" width="536">
<p class="Style10"><strong>LOAN IN OTHER FINANCIAL INSTITUTION</strong></p>
</td>
<td valign="top" width="131">
<p class="Style10"><strong>&nbsp;</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>Institution</p>
</td>
<td valign="top" width="132">
<p>Amount Advanced</p>
</td>
<td valign="top" width="103">
<p>Date Advanced</p>
</td>
<td valign="top" width="96">
<p>Repayment Period</p>
</td>
<td valign="top" width="131">
<p>Outstanding Amount</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>&nbsp;</p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>&nbsp;</p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>&nbsp;</p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>(Attach bank Statements)</p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>Agency Name (if Applicable)</p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p><strong>SECURITY DETAILS</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>Type</p>
</td>
<td valign="top" width="132">
<p>Details</p>
</td>
<td valign="top" width="103">
<p>Estimate Value</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>&nbsp;</p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p>&nbsp;</p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p><strong>(Attach Copies of Securities)</strong></p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td valign="top" width="103">
<p>&nbsp;</p>
</td>
<td valign="top" width="96">
<p>&nbsp;</p>
</td>
<td valign="top" width="131">
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p><strong>DECLARATION</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td colspan="5" valign="top" width="668">
<p><strong>I</strong>/WE declare that the Information given herein is true of my/our knowledge and belief. I/we further authorize the lender to verify the information given herein and make reference from any person(s) including credit reference bureaus.</p>
</td>
</tr>
<tr>
<td valign="top" width="30">
<p class="Style10">&nbsp;</p>
</td>
<td valign="top" width="206">
<p><strong>Signature of Applicant</strong></p>
</td>
<td valign="top" width="132">
<p>&nbsp;</p>
</td>
<td colspan="3" valign="top" width="330">
<p>Date</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>

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
