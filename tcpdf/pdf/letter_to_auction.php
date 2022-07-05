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
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
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
<style>
body{
 text-align:justify;
 font family:serif;
 font: size 12px;
}
</style>

<body>
<p class="Style1"><span style="text-decoration: underline;">LETTER OF INSTRUCTION</span></p>
<p class="Style2">&nbsp;</p>
<p class="Style2">Date: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style2">&nbsp;</p>
<p class="Style7">&nbsp;</p>
<p class="Style7">To: Name and address of auctioneer:</p>
<p class="Style7">&nbsp;</p>
<ol>
<li>Name and address of instructing party: Tamika Credit Limited</li>
</ol>
<p class="Style3">P.O Box 7444-00100</p>
<p class="Style3"><span style="text-decoration: underline;">&nbsp;Nairobi</span></p>
<p class="Style3">&nbsp;</p>
<p class="Style4">2.Name and address of instructing advocate</p>
<p class="Style4">&nbsp;</p>
<p class="Style4">&nbsp;</p>
<p class="Style4">3.(a) Name and address of property owner:</p>
<p class="Style4">Name:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p class="Style6">&nbsp;</p>
<p class="Style6">P.O BOX.&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style6"><span style="text-decoration: underline;">&nbsp;</span></p>
<p class="Style6">PHONE:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p class="Style6">&nbsp;</p>
<p class="Style7">(b) Name, Customer number and address of principal debtor:</p>
<p class="Style6">&nbsp;</p>
<p class="Style6">P.O BOX &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</p>
<p class="Style6"><span style="text-decoration: underline;">&nbsp;</span></p>
<p class="Style6">PHONE:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p class="Style5">(a)Physical address of property to be seized/repossessed and sold as per annexure.</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style5">&nbsp;</p>
<p class="Style4">(b)Person to point out locality and property: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style4">(c)&nbsp; Legal description of property to be seized/repossessed and sold: LAND TITLE NO. &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p class="Style4">5.Statutory provisions under which seizure/repossessed and sale is authorized:</p>
<p class="Style4">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<ol>
<li>(a) Amount to be recovered as at date of letter of instruction KSH&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</li>
</ol>
<p class="Style4">&nbsp;</p>
<p class="Style1">(b) Daily rates thereafter (interest/rent/storage): Interest per Month Ksh&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.p.m. Penalty Interest Ksh&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip; p.m.</p>
<p class="Style3">7.Additional charges to be recovered:</p>
<p>&nbsp;</p>
<p class="Style3">(a)Estimated legal cost: Ksh&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;..</p>
<p class="Style1">TBA</p>
<p class="Style1">&nbsp;</p>
<p class="Style3">(b) Estimated Auctioneers fees: KSh. TBA</p>
<p class="Style1">&nbsp;</p>
<p class="Style3">8.Reserve prices or reasons for selling without reserve:</p>
<p class="Style3">&nbsp;</p>
<p class="Style3">9.Advertising instruction/expenditure authorized:</p>
<p class="Style3">10.&nbsp; We the instructing party or its advocate on its behalf hereby:</p>
<p class="Style3">(i)Confirm that all statutory conditions precedent to seizure/repossession and sale have been<br /> Complied with;</p>
<p class="Style3">(ii)Request you to sell the property described in paragraph 4 by public auction at the best price obtainable subject to the reserve prices indicated in paragraph 8;</p>
<p class="Style3">(iii)Hereby agree to indemnify you against all costs, damage, losses and expenses you may Incur in the lawful exercise of your duties as a licensed auctioneer;</p>
<p class="Style3">(iv)Agree to pay your charges as per fees already agreed/as specified in the Auctioneers Rules.</p>
</body>

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
