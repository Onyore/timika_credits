<?php
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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

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
// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('times', '', 10, '', true);

// add a page
$pdf->AddPage();

// set some text to print
$html= <<<EOD

<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; LOAN CASH DISBURSEMENT</strong></p>
<p class="Style10">&nbsp;</p>
<table border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td valign="top" width="301">
<p class="Style10">For Official use only: Disbursement Details</p>
</td>

<td valign="top" width="108">
<table cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td bgcolor="white" width="279" height="400">
<table style="width: 100%;" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>

<div class="shape">
<p><strong>Receipt of Cash by Customer</strong></p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>No.</strong></p>
<p>Clients Name: ____________________</p>
<p>I have received Kshs________________ (In words)</p>
<p>_______________________________________________________________________________________________________________________________________</p>
<p>Signature___________ Date___________</p>
<p>&nbsp;</p>
<p>Witnessed by Tamika Credit Ltd Official</p>
<p>Name_____________________________</p>
<p>&nbsp;</p>
<p>Signature______________ Date________</p>
</div>
</td>
</tr>
</tbody>
</table>
&nbsp;</td>
</tr>
</tbody>
</table>
<p class="Style10">Kshs.</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Total Loan Application</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Deductions: Lace</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Witnessing Fee:</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Insurance</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Loan Balance</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Chattels</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Others (i)</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">(ii)</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">(iii)</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Total Deductions</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
<tr>
<td valign="top" width="301">
<p class="Style10">Net Cash to pay after Perfection</p>
</td>
<td valign="top" width="108">
<p class="Style10">&nbsp;</p>
</td>
</tr>
</tbody>
</table>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p class="Style10">&nbsp;</p>
<p>&nbsp;</p>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('loan disbursement.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
