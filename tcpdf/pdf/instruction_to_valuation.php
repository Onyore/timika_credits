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
		// $this->MultieCell(189,15, 'TRV Towers, Ngara Rd, 8th Floor Wing 8A P.O BOX 7444 – 00100 Nairobi. TEL: 0714900000
		// EMAIL: info@tamika.co.ke   Website: www.tamika.co.ke', 0,'L', 0,1,'','',true);
		$this->Cell(0, 10, 'TRV Towers, Ngara Rd, 8th Floor Wing 8A P.O BOX 7444 – 00100 Nairobi. TEL: 0714900000 EMAIL: info@tamika.co.ke   Website: www.tamika.co.ke', 0, false, 'C', 0, '', 0, false, 'T', 'M');
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

<p class="Style6">Our Ref: TCL/&hellip;&hellip;&hellip;../&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style6">&nbsp;</p>
<p class="Style6">Date: &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p class="Style6">&nbsp;</p>
<p class="Style6">Dear &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p class="Style6">P.O. Box &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style6">Nairobi.</p>
<p class="Style6">&nbsp;</p>
<p class="Style6">Owner:&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;ID:&hellip;&hellip;&hellip;&hellip;. Property&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style1">Kindly provide a comprehensive valuation report over the above property. The valuation should incorporate the following:</p>
<ol>
<li>Current Market Value for:<ol>
<li>Open market</li>
<li>Insurance purposes</li>
<li>Forced sale purposes</li>
<li>Value of land</li>
</ol></li>
<li>Land reference number&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;<ol>
<li>Exact location in relation to the neighboring area.</li>
<li>Name and/or brief description of neighboring landmarks.</li>
</ol></li>
<li>Area covered.</li>
<li>Gradient of plot.</li>
<li>Tenure of property i.e., freehold/leasehold. State the unexpired term of the lease.</li>
<li>Registered owners.</li>
<li>Ground rent/land rates in Kshs.</li>
</ol>
<p class="Style5">10.Encumbrances (if any)</p>
<p class="Style5">11.Developments)</p>
<p class="Style5">12.Total build up area (plinth area) in meters/feet (for buildings) and hectares/acres (for land).</p>
<p class="Style5">13.Rented or owner occupied.</p>
<p class="Style5">14.Monthly rent receivable and name(s) of tenant(s)</p>
<p class="Style5">15.Condition of the property.</p>
<p class="Style5">16.Age of the building.</p>
<p class="Style5">17.Confirmation that the property is not developed on land/a plot previously set aside for public utility/use.</p>
<p class="Style5">18.Any factors, adverse or otherwise, which TCL should consider in determining the amount of the advance. In case of business premises, please give your views on nature and suitability of the business vis-a-vis the immediate environment.</p>
<ol>
<li>The report should be accompanied by:<ol>
<li>Search certificate from the land&rsquo;s registry.</li>
<li>Site plan and a copy of the title deed.</li>
<li>Photographs or the property taken from different elevations.</li>
</ol></li>
</ol>
<p class="Style5">20.Current user of the property whether commercial, residential or otherwise.</p>
<ol>
<li>The occupancy of the property:<ol>
<li>Is it owner occupied/rented out?</li>
<li>Number of occupants.</li>
<li>Relation of occupants with the applicant/borrower.</li>
<li>Any other information that may be relevant in determination of marital status of the borrower and whether the properly offered as security is matrimonial property.</li>
<li>Confirmation that they have examined relevant survey maps and that the property described is the one inspected.</li>
</ol></li>
</ol>
<p class="Style6"><span style="text-decoration: underline;">CAUTION</span>:</p>
<p class="Style5">i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; If you have any interest in this property directly or indirectly, please do not proceed to value instead return the valuation to us immediately.</p>
<p class="Style5">ii)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The interest of Tamika Credit Limited must not be disclosed to any tenant or occupier.</p>
<p class="Style5">iii)&nbsp;&nbsp;&nbsp; The report must be submitted in <span style="text-decoration: underline;">duplicate</span> within <span style="text-decoration: underline;">3 </span><span style="text-decoration: underline;">days</span> from the date of receipt of our instructions.</p>
<p class="Style1">Yours faithfully,</p>
<p class="Style1"><span style="text-decoration: underline;">For: Tamika Credit Limited</span></p>
<p class="Style1"><span style="text-decoration: underline;">&nbsp;</span></p>
<p class="Style10"><strong>Sign&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</strong></p>
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
