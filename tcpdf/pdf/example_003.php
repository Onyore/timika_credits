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
$pdf->setFont('times', '', 11);

// add a page
$pdf->AddPage();

// set some text to print
$txt = <<<EOD
Our Ref: TCL/…………………                                         Date …………………………………
 
Name (s) …………………………………………………………………………………………………… 
ID NO………………………………………………………………………………………………………
 
P.O Box…………………………………………. 
 
Dear Sir/Madam, 
LOAN 	FACILITY: 	KSHS……………/=(in word……………………………………………………………………..) 
We are pleased to advise you that further to your application dated ………Month ……….year …………, we offer you a credit facility in accordance with the terms and conditions set out in this letter. 
 
1.	DEFINITIONS AND INTERPRETATION 
In this letter the following words shall have the following meanings:  
"Borrower" means……………………………………………………………………………………………… 
	"lender" means 	Tamika Credit Limited 
P.O. Box 744-00100 
NAIROBI 
 
2.	PURPOSE OF FACILITY 
The 	proposed 	facility 	will 	be 	utilized 	by 	die 	borrower to……………………………………………………………………………………………………………………… 
3.	AMOUNT OF THE FACILITY AND REPAYMENT 
The maximum amount that will be available for draw down under the proposed facility shall not exceed the aggregate sum of Kenya Shillings Kshs. ……………………………………… The facility will be repaid directly by the borrower in monthly "installment comprising of both principal and interest of Ksh………………. each. The repayment will be expected on the …………….. of every month starting from  Date…………Month 	……………. 	year 	…………….. 	and 	end 	in 	on 	or 	before Date…………Month……..Year…………………. 
 
	TO 	ENSURE 	THAT 	YOUR 	PAYMENT 	REFLECTS 	INTO 	YOUR 
STATEMENTS. PLEASE NOTE THE FOLLOWING:- 
i.	Pay at Tamika Credit Limited pay bill number …………….and indicate your TCL account number…………… as the account number. If these details are not indicated on your account will not be credited and you will be charged a penalty of Kshs…………………00. OR 
ii.	Pay at our Bank Account as follows. …………………………………………….. Bank, and indicate your Name and TCL account number….…………… 
Name………………… Please note that any Payment without indicating name and TCL account Number will not go through and hence your account will not be credited. OR 
iii.	Give Cheques to Tamika Credit Ltd but Indicate your Name in full and your account number at the back of the cheque. Please do not bank the cheque yourself (directly) to any of our accounts. All Cheques are banked by Tamika Credit Ltd in an account designated for Cheques only. 
 
iv.	Do not make any payment through Bank Agents or Tamika Credit Limited Agents as your TCL account number will not reflect in our account and your payment will not be reflected in your account. We completely do not accept any payment made through any Agents. 
 
v.	If you want to pay through any other bank or method, please obtain Special Written Authority Tamika Credit Ltd. 
 
4.	INTEREST AND COMMISSIONS 
All advances made under the proposed facility shall attract interest from the date of draw down (as well as after and before any demand or judgment or the liquidation of the Borrower) at a flat rate of Six Percent (……………..%) per month or such other rate as may be determined by the Lender from time to time. The Lender reserves the right to amend interest charges without prior notice to the Borrower. 
The proposed facility will also attract a loan application and credit evaluation fee for the services provided to the Borrower in evaluating the proposal for the facility. The borrower will be required to pay Kshs……………………………………………………………………... also you will be required to pay Credit life insurance of Kshs…………………………………………………………………. 
5.	ADDITIONAL INTEREST 
If the Borrower fails to pay any sum payable under the proposed facility on its due date, the Borrower shall pay interest on such sums from the date of such failure to the date of actual payment (as well as after and before any demand, judgment or the liquidation of the Borrower) at the rate of ………………………per cent (………%) per month above the rate specified in clause 4 of this letter. Such interest shall be payable at any time on demand and represents a reasonable pre-estimate of the loss to be suffered by the Lender in funding the default of the Borrower. 
6.	SECURITY 
 
The proposed facility will be secured by Motor vehicle registration no……………………….…, Land title number …………………………………………………………………….and all household chattels. 
 
NB: The customer will bear all costs related with regard to perfection of securities 
Conditions of Sanction 
	Payment of loan application fees, credit life fee and witnessing Fee. 
	Joint registration of Motor vehicle registration no ………………………………………….. 
	Valuation and Installment of car track on motor vehicle Registration no 
………………………………………………………………….. 
	Search of Land title number……………………………………………….. 
	Notification of insurance for the motor vehicle used as security 
	Registration of securities 
	Pay for any other expenses that might be reasonably incurred during the perfection of securities.  
7.	UNDERTAKINGS 
So long as the proposed facility is available or outstanding, the Borrower undertakes with the Lender as follows: 
a)	The Borrower shall provide the Lender with such information and documents concerning the Borrower’s employment/business and financial position and prospects as may from time to time be requested; 
b)	In case of pay off by another financier, the borrower will be required to pay the lender an interest of ……………..% on the outstanding balance. 
8.	FEES AND EXPENSE 
The Borrower shall pay to the Lender on demand on a full indemnity basis, all expenses (including legal fees of the Lender's and the Borrower's Advocates and out-of-pocket expenses together with any taxes if any thereon), auctioneer's costs connected with the recovery of money's owing under the facility as well as the contesting of any involvement in any legal proceedings of whatever nature by the lender for the protection of or in connection with any account(s) or assets of the Borrower and also in connection with the negotiation, preparation and execution of this letter and/or the security documents, the fulfillment of all conditions of the propose facility and/or otherwise in respect of any monies owing under or in respect of the proposed facility 
9.	CREDIT REFERENCE BUREAUS 
The Borrower expressly consents and allows the lender to forward personal data and full file credit information to licensed credit reference bureaus. 
 
10.	IRREGULAR PAYMENTS 
Irregular payments may result to any of the following delinquency management methodologies: 
a) Stop Cheque 
The Borrower may request for a postponement of cheque banking that the Lender may grant for a short duration not exceeding four (4) days. The Borrower however agrees to bear the cost of any cheque that is not banked on its due date, as per the Lender's existing company fees guideline. 
b) Bounced Cheque ** 
In case a cheque bounces, the Borrower agrees to pay the amount of the cheque that bounces, bounced cheque charges and third party bounced cheque collection charges if the cheque remains unpaid for four (4) days. c) Restructure 
In the instance that the Borrower requests to pay the loan in terms different from the initial offer letter, the Lender may grant the request (Restructure) at the Borrower's cost as guided by the Lender's fees guideline. The fees must be paid before the payment terms are changed. 
 
 
11.	DEFAULT 
a. The following events will constitute default and cause any amount outstanding under the proposed facility to become immediately due and repayable and any commitments hereunder cancelled: 
(i)	The failure of the Borrower to observe or perform any other obligations under this letter and/or the security documents. 
(ii)	If any circumstances arise which in the opinion of the Lender have or may have a material adverse effect on the Borrower's ability to perform its obligations under this letter and/or the security documents?  
(iii)	The Borrower admits in writing its inability to pay or shall become unable to pay its debts generally as they fall due, or become bankrupt or insolvent, or file any petition or action for relief under any bankruptcy, reorganization, and insolvency law. 
(iv)	The Borrower suspends or threatens to suspend its operations or, except in the ordinary course of business, sell, lease, transfer or otherwise dispose of all or any substantial part of the Borrower's assets (whether by a single transaction or by a series) or all or any part of its assets are seized or appropriated by or on behalf of any governmental or other authority or are compulsorily acquired. 
(v)	Any of the Borrower's indebtedness is not paid on its due date or becomes due prior to its stated maturity or any guarantee given by the Borrower is not honored when due or called upon. 
(vi)	The Borrower will indemnify the Lender against any loss (including loss of profit) or expense which may be incurred as a consequence of any default in payment by the Borrower of any sum hereunder When due and/or the occurrence of any event of default. 
 
12.	LAW 
This letter shall be governed by the laws of the Republic of Kenya. The Borrower hereby irrevocably submits to the jurisdiction of the Kenyan Courts. The submission to jurisdiction by the Borrower shall not prevent proceeding being brought in any other competent Court. 
 

 
 
13.	GENERAL 
The proposed facility is subject to, (without limitation) to the terms and conditions outlined above. Please sign and return the enclosed copy of this letter by way of acceptance of this offer on the terms and conditions contained herein. The offer contained in this letter will automatically lapse if it is not accepted and delivered to the Lender together with all duly executed documents within 14 days of the date of this letter. 
Yours faithfully, 
 
Tamika Credit Ltd                                             
	……………………………….. 	 	 	 	 	 	 
Head of Sales & Marketing 
………………………………….. 
Head of Operations 
 
I, confirm that I have read, understood and accepted the offer contained in this letter subject to the above terms and conditions. 
Client: Name: ____________________________________________ 
Signature: __________________                                         Date:_____________ 
 
Witnessed by: _______________________________ Date: ____________ 
 
NOTE: 
1)	The Borrower must initial all the pages of the letter of offer. 
2)	Any alterations to the Letter of Offer must be initiated by the Borrower and the Lender.  
 
 
 
 


EOD;

// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, '', true, 0, false, false, 0);


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
