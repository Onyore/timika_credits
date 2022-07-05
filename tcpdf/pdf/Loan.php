<?php



// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

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
$pdf->setFont('times', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD




 <table  border="1" cellspacing="0" cellpadding="0"  > 
<tbody>
<tr>
 <td  valign="top" ><p>1.</p></td>
 <td  colspan="5" valign="top" ><p><strong>CUSTOMER’S PERSONAL INFORMATION</strong></p>

  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>Applicant’s Name (Mrs./Mrs./Miss: <strong> $firstname $middlename $lastname</strong></p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>Trading As:</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>National ID/Passport No. <strong>$id_no</strong> (Attach Copy)</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>Marital Status <strong>$marital</strong> </p></td>

 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td colspan="5" valign="top" ><p>Date of Birth: <strong>$dob</strong></p></td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>Postal Address Current</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>Permanent Address</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>Tel: (Landline) </p></td>
 <td  colspan="2" valign="top" ><p>Mobile </p></td>
 <td  colspan="2" valign="top" ><p>Email:</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>Residence: Town</p></td>
 <td  colspan="2" valign="top" ><p>Estate</p></td>
 <td  colspan="2" valign="top" ><p>Estate</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>House No.</p></td>
 <td  colspan="2" valign="top" ><p>Rented</p></td>
 <td  colspan="2" valign="top" ><p>Owned</p></td>
 </tr>

 <tr>
 <td  valign="top" ><p>2.  </p></td>
 <td  colspan="4" valign="top" ><p><strong>BUSINESS DETAILS </strong></p>

  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>Nature of Business</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>Physical Address (Attach Sketch)</p></td>
 <td  colspan="2" valign="top" ><p>Town</p></td>
 <td  colspan="2" valign="top" ><p>Building</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p>Street No. of Years in this Business</p></td>
 </tr>

 <tr>
 <td  valign="top" ><p>3.  </p></td>
 <td  colspan="5" valign="top" ><p><strong>LOAN PARTICULARS </strong></p>

  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="3" valign="top" ><p>Amount applied for (Kshs)</p></td>
 <td  valign="top" ><p>Purpose</p></td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="3" valign="top" ><p>Cost of Project (Kshs)</p></td>
 <td  colspan="2" valign="top" ><p>Own Contribution (Kshs)</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="3" valign="top" >  </td>
 <td  colspan="2" valign="top" ><p>Monthly Repayments (Kshs)</p></td>
 </tr>

 <tr>
 <td  valign="top" ><a name="_Hlk107663763"></a>  </td>
 <td  colspan="4" valign="top" ><p><strong>LOANS IN OTHER FINANCIAL INSTITUTIONS </strong></p>

   </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>Institution </p></td>
 <td  valign="top" ><p>Amount Advanced</p></td>
 <td  valign="top" ><p>Date Advanced</p></td>
 <td  valign="top" ><p>Repayment Period </p></td>
 <td  valign="top" ><p>Outstanding Amount</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>(Attach bank Statements)</p></td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>Agency Name (if Applicable)</p></td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" ><p>4.  </p></td>
 <td  colspan="5" valign="top" ><p><strong>SECURITY DETAILS </strong></p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p>Type </p></td>
 <td  valign="top" ><p>Details </p></td>
 <td  valign="top" ><p>Estimate Value</p></td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p><strong>(Attach Copies of Securities)</strong></p></td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 <td  valign="top" >  </td>
 </tr>

 <tr>
 <td  valign="top" ><p>5.  </p></td>
 <td  colspan="5" valign="top" ><p><strong>DECLARATION</strong></p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  colspan="5" valign="top" ><p><strong>I</strong>/WE declare that the Information given herein is true of my/our knowledge and belief. I/we further authorize the lender to verify the information given herein and make reference from any person(s) including credit reference bureaus.</p></td>
 </tr>

 <tr>
 <td  valign="top" >  </td>
 <td  valign="top" ><p><strong>Signature of Applicant </strong></p></td>
 <td  valign="top" >  </td>
 <td  colspan="3" valign="top" ><p>Date </p></td>
 </tr>

 </tbody>
</table>

 

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
