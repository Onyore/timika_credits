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
$street=$data['street'];
$id_no=$data['id_no'];
$marital=$data['marital'];
$dob=$data['dob'];
$address=$data['address'];
$estate=$data['estate'];
$email=$data['email'];
//$id_no=$data['id_no'];

//SELECTING FROM LOAN LIST TABLE
$query=mysqli_query($con,"SELECT * FROM loan_list where id=$id");
//echo $query;
$row=mysqli_fetch_array($query);
//$firstname=$row['firstname'];
//print_r ($row);

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
$pdf->setFont('times', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<br/S> <br/>
<p class="Style2" align="center"><strong>BUSINESS LOAN APPLICATION FORM &ndash; INDIVIDUAL</strong></p>
<p class="Style10"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For Official Use Only</strong></p>
<p class="Style10"><strong>HEAD OFFICE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>Loan A/c No. &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style10">P.O. BOX 7444-00100. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</p>
<p class="Style10"><strong>Nairobi</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p class="Style10">TRV Towers, 8<sup>th</sup> floor, Wing 8A&n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p class="Style10">Tel: 0714900000</p>

<p><br></br></p>
<h4 text-align="center"> CUSTOMERS PERSONAL INFORMATION</h4>
<p><b>Applicants Name:</b> Mr/Mrs/Miss :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $lastname &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $firstname  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $middlename </p>
<br>
<p><b>Trading As:</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Single Business    </p>
<br>
<p><b>Marital Status: </b>   $marital    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;       <b>NATIONAL ID NO:</b>   $id_no     </p>                             
<br>
<p><b>Tel: </b>   0712315075 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Mobile</b>   0712315075 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    <b> Email:</b>   $email      </p>  
<p><b>Current Address: </b>    $address &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Street</b> $street  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <b>House No</b> 2345     </p> 

<br>
</br>

<h4><u>BUSINESS DETAILS</u></h4>
<p><b> Nature of Business:</b> </p>
<p><b>Physical Address: </b> (Attach Sketch) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b>Town</b> Kasarani Mwiki  &nbsp;&nbsp;     <b>Bulding No</b> 2345   &nbsp;&nbsp;   <b>Street</b>  </p> 
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
    <td></td>
    <td></td>
	<td></td>
    <td></td>
	<td></td>
  </tr>
  
</table>
<p>
Attach bank Statement <br/>
Agency Name (If Applicable)
</p>

<h4> Security</h4>
<table>
  <tr>
    <th><b>Type</b></th>
    <th><b>Detail</b></th>
    <th><b>Estimate</b></th>
  </tr>
  <tr>
	<td></td>
    <td></td>
	<td></td>
  </tr>
</table>
<p> Attach all copies of Security</p>
<p><br></br></p>
<h4> Declaration</h4>
<p>I/WE declare that the Information given herein is true of my/our knowledge and belief. I/we further authorize the lender to verify the information given herein and make reference from any person(s) including credit reference bureaus.</p>
<p>Signature of Applicant_________________ 		Date __________________________ </p>


EOD;



// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Timika Loan Application.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
