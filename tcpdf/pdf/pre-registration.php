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
$pdf->setTitle('Pre-Registration Forms');
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
 font: size 10px;
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
<p align="center"><strong>PRE-REGISTRATION CHECKLIST</strong></p>
</td>
</tr>
<tr>
<td valign="top" width="315">
<p><strong>Name of Borrower: $firstname &nbsp; $middlename &nbsp; $lastname</strong></p>
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
<p><strong>1. Loan Agreement </strong></p>
<ul>
<li>Correct names of the borrower as per the ID</li>
<li>30 days&rsquo; notice clause</li>
<li>Terms of repayment and purpose of the facility as per the offer letter</li>
<li>Properly executed by the borrower and witnessed by an advocate</li>
<li>Generally, in tandem with all the terms of the offer letter</li>
</ul>
<p><strong>2. Charge </strong></p>
<ul>
<li>Tamika Credit Limited&rsquo;s template as per the land regime</li>
<li>Correct name and address of the Chargor as it appears on Title Deed</li>
<li>Correct name and address of the Chargee</li>
<li>Properly executed by the Chargor and or Borrower and duly witnessed by an advocate</li>
<li>Spousal consent dully filled with correct ID number and witnessed by an independent advocate</li>
<li>Different advocates to witness different signatures</li>
<li>If spouse is dead attach proof like death certificate</li>
<li>Affidavit by the Chargor if single attesting to that fact</li>
<li>Affidavit by the Chargor if the names on the ID and Title Deed do not tally</li>
</ul>
<p><strong>3. Deed of guarantee of indemnity </strong></p>
<ul>
<li>If Chargor is not a borrower provide guarantee of indemnity supporting the amount charged</li>
<li>Guarantee amount should support the charged amount</li>
</ul>
<p>Guarantor should acknowledge receipt of the copy of the guarantee</p>
</td>
<td valign="top" width="315">
<p><strong>1. Deed of assignment </strong></p>
<ul>
<li>Correct name and address of the Assignor as per the Title Deed</li>
<li>Correct name and address of the Assignee/Lender</li>
<li>Consideration is the amount charged</li>
</ul>
<p><strong>2. Company </strong></p>
<ul>
<li>Provide us with a CR12</li>
<li>Exemption of Article 79 on the Articles of Association</li>
</ul>
<p><strong>3. Corporate guarantee </strong></p>
<ul>
<li>Memorandum and Articles of Association allows it to guarantee third parties</li>
<li>Commercial benefit that will accrue to the company as a guarantor</li>
</ul>
<p><strong>4. Debenture </strong></p>
<ul>
<li>Correct name and address of the company as it appears on the Certificate of Incorporation</li>
<li>Properly executed by the Directors of the company, sealed by the company seal and duly witnessed by an advocate</li>
</ul>
<p>&nbsp;</p>
<p><strong>5. Resolutions </strong></p>
<ul>
<li>Resolutions dated within the acceptance period of the offer letter (within 30 days)</li>
<li>Accepts the facility as per the terms of the Offer Letter</li>
<li>Duly executed</li>
</ul>
<p><strong>&nbsp;6. Fees </strong></p>
<ul>
<li>Fees (as agreed) should always be paid by the Borrower before execution of documents</li>
</ul>
</td>
</tr>
</tbody>
</table>

EOD;



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Pre-Registration.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
