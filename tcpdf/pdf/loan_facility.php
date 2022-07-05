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
<p>Our Ref: TCL/____________________ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Date ____________________</p>
<p>Name (s) ____________________</p>
<p>&nbsp;ID NO_________________________</p>
<p>P.O Box_________________________</p>
<p><br></p>
<p><br></p>
<p>Dear Sir/Madam,&nbsp;</p>
<p><strong>LOAN FACILITY</strong>: <strong>KSHS_____________/=(in word ___________________________) </strong></p>
<p>We are pleased to advise you that further to your application dated _______Month _______year ________, we offer you a credit facility in accordance with the terms and conditions set out in this letter.</p>
<p><br></p>
<p>&nbsp;<strong>1. DEFINITIONS AND INTERPRETATION&nbsp;</strong></p>
<p>In this letter the following words shall have the following meanings:</p>
<p>&nbsp;&quot;Borrower&quot; means ____________________</p>
<p>&nbsp;&quot;lender&quot; &nbsp; &nbsp; &nbsp;means &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>Tamika Credit Limited&nbsp;</strong></p>
<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;P.O. Box 744-00100&nbsp;</strong></p>
<p><strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; NAIROBI</strong></p>
<p><br></p>
<p>&nbsp;<strong>2. PURPOSE OF FACILITY&nbsp;</strong></p>
<p>The proposed facility will be utilized by die borrower to _______________________________________________</p>
<p><br></p>
<p><strong>3. AMOUNT OF THE FACILITY AND REPAYMENT </strong></p>
<p>The maximum amount that will be available for draw down under the proposed facility shall not exceed the aggregate sum of Kenya Shillings Kshs. _____________ The facility will be repaid directly by the borrower in monthly &quot;installment comprising of both principal and interest of Ksh________________each. The repayment will be expected on the ___________of every month starting from &nbsp;Date_____________Month ____________ year ________________ and end in on or before Date _____________Month ___________Year __________</p>
<p><strong>TO ENSURE THAT YOUR PAYMENT REFLECTS IN YOUR STATEMENTS. PLEASE NOTE THE FOLLOWING:-</strong></p>
<p>&nbsp;i. Pay at Tamika Credit Limited pay bill number &hellip;&hellip;&hellip;&hellip;&hellip;.and indicate your TCL account number&hellip;&hellip;&hellip;&hellip;&hellip; as the account number. If these details are not indicated on your account will not be credited and you will be charged a penalty of Kshs&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;00. OR&nbsp;</p>

<p>ii. Pay at our Bank Account as follows. &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.. Bank, and indicate your Name and TCL account number&hellip;.&hellip;&hellip;&hellip;&hellip;&hellip; Name&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip; Please note that any Payment without indicating your name and TCL account Number will not go through and hence your account will not be credited. OR&nbsp;</p>

<p>iii. Give Cheques to Tamika Credit Ltd but Indicate your Name in full and your account number at the back of the cheque. Please do not bank the cheque yourself (directly) to any of our accounts. All Cheques are banked by Tamika Credit Ltd in an account designated for Cheques only.&nbsp;</p>
<p>iv. Do not make any payment through Bank Agents or Tamika Credit Limited Agents as your TCL account number will not reflect in our account and your payment will not be reflected in your account. We completely do not accept any payment made through any Agents.&nbsp;</p>
<p>v. If you want to pay through any other bank or method, please obtain Special Written Authority Tamika Credit Ltd.&nbsp;</p>
<p><br></p>
<p><strong>4. INTEREST AND COMMISSIONS</strong></p>
<p>&nbsp;All advances made under the proposed facility shall attract interest from the date of draw down (as well as after and before any demand or judgment or the liquidation of the Borrower) at a flat rate of Six Percent (____________%) per month or such other rate asmay be determined by the Lender from time to time. The Lender reserves the right to amend interest charges without prior notice to the Borrower. The proposed facility will also attract a loan application and credit evaluation fee for the services provided to the Borrower in evaluating the proposal for the facility. The borrower will be required to pay Kshs___________________________________________ &nbsp;also you will be required to pay Credit life insurance of Kshs___________________________________________&nbsp;</p>
<p><br></p>
<p><strong>5. ADDITIONAL INTEREST</strong></p>
<p>&nbsp;If the Borrower fails to pay any sum payable under the proposed facility on its due date, the Borrower shall pay interest on such sums from the date of such failure to the date of actual payment (as well as after and before any demand, judgment or the liquidation of the Borrower) at the rate of ______________percent (__________%) per month above the rate specified in clause 4 of this letter. Such interest shall be payable at any time on demand and represents a reasonable pre-estimate of the loss to be suffered by the Lender in funding the default of the Borrower.&nbsp;</p>
<p><br></p>
<p><strong>6. SECURITY</strong></p>
<p>&nbsp;The proposed facility will be secured by Motor vehicle registration no, Land title number _________and all household chattels.&nbsp;</p>
<p><strong>NB</strong>: The customer will bear all costs related with regard to the perfection of securities Conditions of Sanction&nbsp;</p>
<ol>
    <li>Payment of loan application fees, credit life fee, and witnessing Fee.</li>
    <li>&nbsp;Joint registration of Motor vehicle registration no __________________</li>
    <li>Valuation and Installment of car track on motor vehicle Registration no __________</li>
    <li>&nbsp;Search of Land title number_________________</li>
    <li>Notification of insurance for the motor vehicle used as security&nbsp;</li>
    <li>Registration of securities&nbsp;</li>
    <li>&nbsp;Pay for any other expenses that might be reasonably incurred during the perfection of securities. </li>
</ol>
<p><br></p>
<p><strong>7. UNDERTAKINGS&nbsp;</strong></p>
<p>So long as the proposed facility is available or outstanding, the Borrower undertakes with the Lender as follows:</p>
<p>&nbsp;a) The Borrower shall provide theLender with such information and ___________documents concerning the Borrower&rsquo;s employment/business and financial position and prospects as may from time to time be requested;&nbsp;</p>
<p>&nbsp;b) In case of payoff by another financier, the borrower will be required to pay the lender interest of % on the outstanding balance.&nbsp;</p>
<p><br></p>
<p><strong>8. FEES AND EXPENSE&nbsp;</strong></p>
<p>The Borrower shall pay to the Lender on demand on a full indemnity basis, all expenses (including legal fees of the Lender&apos;s and the Borrower&apos;s Advocates and out-of-pocket expenses together with any taxes if any thereon), auctioneer&apos;s costs connected with the recovery of money&apos;s owing under the facility as well as the contesting of any involvement in any legal proceedings of whatever nature by the lender for the protection of or in connection with any account(s) or assets of the Borrower and also in connection with the negotiation, preparation and execution of this letter and/or the security documents, the fulfillment of all conditions of the proposed facility and/or otherwise in respect of any monies owing under or in respect of the proposed facility.</p>
<p><br></p>
<p><strong>&nbsp;9. CREDIT REFERENCE BUREAUS&nbsp;</strong></p>
<p>The Borrower expressly consents and allows the lender to forward personal data and full file credit information to licensed credit reference bureaus.&nbsp;</p>
<p><br></p>
<p><strong>10. IRREGULAR PAYMENTS</strong></p>
<p>&nbsp;Irregular payments may result in any of the following delinquency management methodologies:</p>
<p>&nbsp;a) Stop Cheque The Borrower may request for a postponement of cheque banking that the Lender may grant for a short duration not exceeding four (4) days. The Borrower however agrees to bear the cost of any cheque that is not banked on its due date, as per the Lender&apos;s existing company fees guideline.&nbsp;</p>
<p>b) Bounced Cheque ** In case of a cheque bounces, the Borrower agrees to pay the amount of the cheque that bounces, bounced cheque charges and the third party bounced cheque collection charges if the cheque remains unpaid for four (4) days.</p>
<p>&nbsp;c) Restructure In the instance that the Borrower requests to pay the loan in terms different from the initial offer letter, the Lender may grant the request (Restructure) at the Borrower&apos;s cost as guided by the Lender&apos;s fees guideline. The fees must be paid before the payment terms are changed.&nbsp;</p>
<p><br></p>
<p><strong>11. DEFAULT</strong></p>
<p>&nbsp;a. The following events will constitute default and cause any amount outstanding under the proposed facility to become immediately due and repayable and any commitments hereunder canceled:</p>
<p>&nbsp;(i) The failure of the Borrower to observe or perform any other obligations under this letter and/or the security documents. (ii) If any circumstances arise which in the opinion of the Lender have or may have a material adverse effect on the Borrower&apos;s ability to perform its obligations under this letter and/or the security documents?</p>
<p>&nbsp;(iii) The Borrower admits in writing its inability to pay or shall become unable to pay its debts generally as they fall due, or become bankrupt or insolvent, or file any petition or action for relief under any bankruptcy, reorganization, and insolvency law.&nbsp;</p>
<p>(iv) The Borrower suspends or threatens to suspend its operations or, except in the ordinary course of business, sell, lease, transfer or otherwise dispose of all or any substantial part of the Borrower&apos;s assets (whether by a single transaction or by a series) or all or any part of its assets are seized or appropriated by or on behalf of any governmental or other authority or are compulsorily acquired.&nbsp;</p>
<p>(v) Any of the Borrower&apos;s indebtedness is not paid on its due date or becomes due prior to its stated maturity or any guarantee given by the Borrower is not honored when due or called upon.&nbsp;</p>
<p>(vi) The Borrower will indemnify the Lender against any loss (including loss of profit) or expense which may be incurred as a consequence of any default in payment by the Borrower of any sum hereunder When due and/or the occurrence of any event of default.</p>
<p><br></p>
<p><strong>&nbsp;12. LAW</strong></p>
<p>&nbsp;This letter shall be governed by the laws of the Republic of Kenya. The Borrower hereby irrevocably submits to the jurisdiction of the Kenyan Courts. The submission to jurisdiction by the Borrower shall not prevent the proceeding from being brought to any other competent Court.&nbsp;</p>
<p><br></p>
<p><strong>&nbsp;13. GENERAL&nbsp;</strong></p>
<p>The proposed facility is subject, (without limitation) to the terms and conditions outlined above. Please sign and return the enclosed copy of this letter by way of acceptance of this offer on the terms and conditions contained herein. The offer contained in this letter will automatically lapse if it is not accepted and delivered to the Lender together with all duly executed documents within 14 days of the date of this letter.&nbsp;</p>
<p>Yours faithfully,&nbsp;</p>
<p><br></p>
<p>Tamika Credit Ltd</p>
<p>&nbsp;<span style='color: rgb(0, 0, 0); font-family: "Times New Roman"; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'>___________________________________________</span>&nbsp;</p>
<p>Head of Sales &amp; Marketing</p>
<p><span style='color: rgb(0, 0, 0); font-family: "Times New Roman"; font-size: medium; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;'>___________________________________________</span> .</p>
<p>&nbsp;Head of Operations</p>
<p><br></p>
<p>&nbsp;I, confirm that I have read, understood, and accepted the offer contained in this letter subject to the above terms and conditions.</p>
<p>&nbsp;Client:&nbsp;</p>
<p>Name: ____________________________________________&nbsp;</p>
<p>Signature: __________________ Date:_____________&nbsp;</p>
<p>Witnessed by: _______________________________ Date: ____________&nbsp;</p>
<p><br></p>
<p><strong>NOTE:</strong></p>
<ol>
    <li>The Borrower must initial all the pages of the letter of offer.&nbsp;</li>
    <li>Any alterations to the Letter of Offer must be initiated by the Borrower and the Lender.&nbsp;</li>
</ol>
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
