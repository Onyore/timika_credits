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
//print_r ($data);
$firstname=$data['firstname'];
$lastname=$data['lastname'];
$middlename=$data['middlename'];
//SELECTING FROM LOAN LIST TABLE
$query=mysqli_query($con,"SELECT * FROM loan_list ORDER BY borrower_id");
//echo $query;
$row=mysqli_fetch_array($query);
$amount=$row['amount'];

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
$pdf->setTitle('Post-Registartion formSS');
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
$pdf->setFont('times', '', 10, '', true);

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
<table style="width: 630px;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td colspan="2" valign="top" width="630">
<p align="center"><strong>TAMIKA CREDIT LIMITED (TCL)</strong></p>
</td>
</tr>
<tr>
<td colspan="2" valign="top" width="630">
<p align="center"><strong>POST-REGISTRATION CHECKLIST</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="315">
<p><strong>Name of Borrower: $firstname &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp $middlename &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp $lastname </strong></p>
</td>
<td valign="top" width="315">
<p><strong>Branch:</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="315">
<p><strong>Amount: $amount</strong></p>
</td>
<td valign="top" width="315">
<p><strong>Type of facility: </strong></p>
</td>
</tr>
<tr>
<td colspan="2" valign="top" width="630">
<p><strong>NOTE: By ticking in the box by the associate or partner before returning the documents for execution by TCL</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="315">
<p><strong>Perfection </strong></p>
<ul>
<li>All documents should be accompanied by a forwarding letter</li>
<li>Ensure all registered documents are forwarded to TCL at least in duplicate</li>
<li>Certified copy of the practicing certificate for the advocate witnessing the spousal consent together with the drawn documents for our record/review</li>
<li>Original search</li>
<li>Letter of consent to charge</li>
<li>Land rates and/or rent payment receipt</li>
<li>Land rates and/or rent clearance certificate</li>
<li>KRA stamp duty receipts</li>
</ul>
<p><strong>&nbsp;</strong></p>
</td>
<td valign="top" width="315">
<ul>
<li>Debenture certificate (where applicable)</li>
<li>For sectional property original share Certificate and executed blank share transfer form</li>
<li>Copy of the received letter by the Land Registry, lodged at lands exempting Section 45</li>
<li>Ensure the original copies of the Charge forwarded with instructions are returned for our record</li>
<li>For sectional property/sub-leases apartments always confirm the following are included:</li>
<li>Consent by the management company attached to our charge document</li>
<li>The original share certificates</li>
<li>Blank share transfer forms</li>
</ul>
<p>Confirmation that fees have already been paid by the borrower</p>
</td>
</tr>
<tr>
<td valign="top" width="315">
<p><strong>I being the Partner/Associate in the law firm acknowledge and confirm that I have reviewed the drawn documents and confirm by ticking the boxes above that the documents are in order for execution by TCL&rsquo;s </strong></p>
<p><strong>Attorneys/Directors. By executing this page, I undertake to indemnify TCL for any error, loss, demands, lawsuits, judgments and all actions that may occur as a result of TCL relying on this checklist.</strong></p>
</td>
<td valign="top" width="315">
<p><strong>Name:</strong> &nbsp;</p>
<p><strong>Signature: </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p><strong>Date:&nbsp; </strong></p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>

EOD;



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------
$pdf->AddPage();

// Set some content to print
$html = <<<EOD

<p> Dan </p>

EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('POST-REGISTRATION', 'I');

//============================================================+
// END OF FILE
//============================================================+
