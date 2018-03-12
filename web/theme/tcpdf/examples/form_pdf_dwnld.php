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

include_once('../../config.php');
class MYPDF extends TCPDF {

  //Page header
  // Page footer
  public function Footer() {
    $cur_y = $this->y;
    $this->SetTextColorArray($this->footer_text_color);
    //set style for cell border
    $line_width = (0.85 / $this->k);
    $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
    //print document barcode
    $barcode = $this->getBarcode();
    if (!empty($barcode)) {
      $this->Ln($line_width);
      $barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
      $style = array(
        'position' => $this->rtl?'R':'L',
        'align' => $this->rtl?'R':'L',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'padding' => 0,
        'fgcolor' => array(0,0,0),
        'bgcolor' => false,
        'text' => false
      );
      $this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
    }
    $w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
    if (empty($this->pagegroups)) {
      $pagenumtxt = $w_page.$this->getAliasNumPage().' / '.$this->getAliasNbPages();
    } else {
      $pagenumtxt = $w_page.$this->getPageNumGroupAlias().' / '.$this->getPageGroupAlias();
    }
    $this->SetY($cur_y);
     
    //Print page number
    if ($this->getRTL()) {
      $this->SetX($this->original_rMargin);
      $this->Cell(0, 0, $pagenumtxt, 'T', 0, 'L');
    } else {
      $this->SetX($this->original_lMargin);
      $this->Cell(0, 0, $this->getAliasRightShift().$pagenumtxt, 'T', 0, 'R');
    }
    //$this->SetY(-15);
    $this->ln(4);
    $this->Cell(0, 0, 'Application Form | Melling Capital Management Dynamic Volatility Fund', 0, true, 'L', 0, '', 1, false, 'C', 'M');

    
  }
  public function Header() {
  }
  public function Footer22() {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    $this->ln(4);
    $this->Cell(0, 0, 'Application Form | Melling Capital Management Dynamic Volatility Fund', 0, true, 'L', 0, '', 1, false, 'T', 'M');
  }
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('TCPDF Example 001');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

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
//$pdf->SetFont('dejavusans', '', 14, '', true);
 $pdf->SetFont('times', '', 14, '', true);
//$pdf->SetFont('times', '', 10.5, '', true);    
// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
// top header
// Img
$img = <<<EOD
<img src="Optimized-melling_logo.jpg" style="width:350px; color:black;"/>
EOD;
$pdf->writeHTMLCell(0, 0, '40', '15', $img, 0, 1, 0, true, '', true);
$top_html = <<<EOD
<h2 style="margin-left:100px;color:dark blue;">Dynamic Volatility Fund Application Form</h2>
EOD;
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '50', '60', $top_html, 0, 1, 0, true, '', true);
// text
$pdf->SetFont('times', '', 12, '', true);
$text = <<<EOD
<p style="font-size:14px;">ABN 54 624 456 267</p>
EOD;
$pdf->writeHTMLCell(0, 0, '80', '70', $text, 0, 1, 0, true, '', true);
$text = <<<EOD
<p>Australian Financial Services Licence No. 467 702 (Wholesale clients only)</p>
EOD;
$pdf->writeHTMLCell(0, 0, '45', '75', $text, 0, 1, 0, true, '', true);
$pdf->ln(10);

// text

// investor 1
//if($_SESSION['pdf_investor_1'] != '')
   // $investor_detail = $_SESSION['pdf_investor_1']; 
//else
//{
     $sql = "Select ac.*,c_d.* from user_account as ac
             
             left join company_detail as c_d
             on c_d.acount_owner_id = ac.id
             
             where ac.id = ".$_SESSION['account_owner_id']."
          ";
        //  echo $sql;
         // print_r( $con);
      $result = $con->query($sql);
      $result = $result->fetch_object(); 
      $investor_detail = $result;
      //
      $_SESSION['user_email'] = $investor_detail->email; 

      $sql_invst2 = "SELECT * from user_account
           where parent_investor = ".$_SESSION['account_owner_id']."
           ";
      $result_invst2 = $con->query($sql_invst2);
      $result_invst2 = $result_invst2->fetch_object();
      $investor2_detail =  $result_invst2;

      $bank = "SELECT * from bank_details
           where account_owner_id = ".$_SESSION['account_owner_id']."
           ";
      $result_bank = $con->query($bank);
      $result_bank = $result_bank->fetch_object();
      if($result_bank->distribution_reinvestment == 1)
      {
        $bank = array();
        $distribution_reinvestment = 1;
      }
      else
      {
         $bank = $result_bank;
         $distribution_reinvestment = 0;
       }

      $advisor = "SELECT * from advisor_detail
            where account_owner_id = ".$_SESSION['account_owner_id']."
            limit 1";
      $result_advisor = $con->query($advisor);
      $result_advisor = $result_advisor->fetch_object();
      $advisor = $result_advisor;
      if($_SESSION['section'] == 2)
          $company = $result;
      else 
          $company = '';  
      // Directors
      $direc_names = array();
      $sql_director = "SELECT * from company_directors
           where account_owner_id = ".$_SESSION['account_owner_id']."
           ";
      $result_director = $con->query($sql_director);
      $count = 1; 
      $count_dir = 1;
      $dirc_1 = array();
      $dirc_2 = array();
      while($row = $result_director->fetch_object()) { 
         if($row->given_name != '')
          $direc_names[] = $row->given_name;
         if($count_dir == 1)
         {
             $dirc_1 = $row;
         }
         else
             $dirc_2 = $row; 
          $count_dir++;  
      }
      $director_names = $direc_names;
      
      if($_SESSION['section'] == 4 || $_SESSION['section'] == 3)
           $trust = $result;
      else  
           $trust = '';   

      // beneficiries
      $minnors = "SELECT * from minors
            where account_owner_id = ".$_SESSION['account_owner_id']."
            limit 3  ";
      $result_minnor = $con->query($minnors);
      $count_benef = 1;
      $benef_3 = '';
      while($row = $result_minnor->fetch_object())
      {   
         if($count_benef == 1)
         {
             $benef_1 = $row;
         }
         else if($count_benef == 2)
             $benef_2 = $row;
          else if($count_benef == 3)
             $benef_3 = $row;      
          $count_benef++;  
      }
       $dirc_1 = $investor_detail;       
      $dirc_2 = $investor2_detail;
//} 
// investor 2
//if($_SESSION['pdf_investor_2'] != '')
//$investor2_detail = $_SESSION['pdf_investor_2'];
// Bank detail
//if($_SESSION['pdf_bank_detail'] != '')
//$bank = $_SESSION['pdf_bank_detail'];
// Advisor Detail
//if($_SESSION['pdf_advisor_detail'] != '')
//$advisor = $_SESSION['pdf_advisor_detail'];
// Company Detail
//if($_SESSION['pdf_company_detail'] != '')
//$company =  $_SESSION['pdf_company_detail'];
// directors
//if($_SESSION['pdf_company_directors'] != '')
//$director_names = $_SESSION['pdf_company_directors'];
// Trust detail
//$trust = $_SESSION['pdf_trust_detail'];
$html = '
<p>This fund is available only to Australian residents, Australian companies, Australian Trusts and Australian Self-Managed Super Funds. This fund is not available to US taxpayers.
An active email address is required to invest in this fund.</p>
<table cellpadding="3">
<tr style="background-color:gray;color:white;padding:5px;height:20px;">
   <td style="padding:5px;">1. Investor details</td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>BPAY Ref Number</td>
</tr>
<tr >
   <td> '.($investor_detail->BPay_num != '' ? $investor_detail->BPay_num : '').'</td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>1. A) Name of Investor</td>
</tr>

<tr style="">
   <td>Account name:</td>
</tr>

<tr >
   <td><table border="1px" cellpadding="2"><tr><td>  '.($investor_detail->given_name != '' ? $investor_detail->given_name : '').'</td></tr></table></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>1. B) Contact Details</td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Title</td> <td>Given name(s)</td> <td>Surname</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($investor_detail->title != '' ? $investor_detail->title : '').'</td> 
          <td border="1px"> '.( $investor_detail->given_name != '' ? $investor_detail->given_name : '').'</td> 
          <td border="1px"> '.($investor_detail->family_name != '' ? $investor_detail->family_name : '').'</td>
        </tr>
       </table>
    </td>
</tr>

<tr style="">
   <td>Street Number & Name or PO Box:</td>
</tr>

<tr >
   <td><table border="1px" cellpadding="2"><tr><td> '.($investor_detail->postal_address1 != '' ? $investor_detail->postal_address1 : '').'</td></tr></table></td>
</tr>

<tr style="">
   <td><table >
        <tr>
          <td>Suburb</td> <td>State</td> <td>Postcode</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($investor_detail->suburb != '' ? $investor_detail->suburb : '').'</td> 
          <td border="1px"> '.($investor_detail->state != '' ? $investor_detail->state : '').'</td> 
          <td border="1px"> '.($investor_detail->postal_code != '' ? $investor_detail->postal_code : '').'</td>
        </tr>
       </table>
    </td>
</tr>

<tr style="">
   <td><table >
        <tr>
          <td>Country</td> <td>Email address</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($investor_detail->country != '' ? $investor_detail->country : '').'</td> 
          <td border="1px"> '.($investor_detail->email != '' ? $investor_detail->email : '').'</td> 
        </tr>
       </table>
    </td>
</tr>

<tr style="">
   <td><table >
        <tr>
          <td>Phone number (business hours)</td> <td>Phone number (home)</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"></td> 
          <td border="1px">  '.($investor_detail->mob_no != '' ? $investor_detail->mob_no : '').'</td> 
        </tr>
       </table>
    </td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>1. C) Type of Investor</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Please indicate what type of Investor you are. (ALL APPLICANTS MUST COMPLETE SECTIONS 5 and 6)</td>
</tr>
</table>';

//$pdf->writeHTML($html, true, false, true, false, '');
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Check boxess
$pdf->CheckBox('newsletter', 5, ($investor_detail->account_type == 1 ? true : false), array(), array(), 'OK');
$pdf->Cell(35, 2, 'Individual');
$pdf->Cell(45, 2, '');
$pdf->CheckBox('Company', 5, ($investor_detail->account_type == 2 ? true : false), array(), array(), 'OK');
$pdf->Cell(35, 2, 'Company');
$pdf->ln(8);
$pdf->CheckBox('Trust', 5, ($investor_detail->account_type > 2 ? true : false), array(), array(), 'OK');
$pdf->Cell(35, 5, 'Trust / Superannuation Fund');
$pdf->ln(8);
//$pdf->Cell(35, 5, 'Individual Trustee Company Trustee');

$text2 = <<<EOD
<p >Completed Application Forms, cheques (where applicable) and identification documentation (where applicable) should be mailed to:</p>
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $text2, 0, 1, 0, true, '', true);

// text
$text22 = <<<EOD
<p style="font-size:14px;">FundBPO – Unit Registry<br/>
GPO Box 4968 <br/>
Sydney, NSW 2001</p>
EOD;
$pdf->writeHTMLCell(0, 0, '50', '80', $text22, 0, 1, 0, true, '', true);
$pdf->ln(4);
// text
if($investor_detail->account_type == 1) { 
$text3 = <<<EOD
<p >If you require assistance with completing the Application Form, please call us on 03 9450 5000.
Further information regarding our funds can be accessed on our website: www.melling.com.au
</p>
<table cellpadding="3">
<tr style="background-color:gray;color:white;padding:5px;height:20px;">
   <td>Section 2. Individual(s) / Individual Trustee(s)</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Complete this section if you are an Individual(s) or Individual Trustee(s).</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>The AML/CTF documentation required for processing this application is outlined below.</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>How are you investing?</td>
</tr>
<tr >
   <td></td>
</tr>
</table>
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $text3, 0, 1, 0, true, '', true);


$pdf->CheckBox('1', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'In my name only (Section 2.A)');
$pdf->Cell(40,5, ' ');
$pdf->CheckBox('2', 5, false, array(), array(), 'OK');
$pdf->Cell(50, 5, 'Jointly with other individual(s) (Section 2.A & 2.B)');
$pdf->ln(10);
$pdf->Cell(0, 5, 'If there are additional directors, please provide details as an attachment.');
$pdf->ln(10);
// Section 2 : A
$text2a = '
<table cellpadding="3">
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>2. A) Individual 1</td>
</tr>

<tr style="">
   <td><table >
        <tr>
          <td>Title</td> <td>Given name(s)</td> <td>Surname</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($dirc_1->title != ''? $dirc_1->title : '').'</td> 
          <td border="1px"> '.($dirc_1->given_name != ''? $dirc_1->given_name : '').'</td> 
          <td border="1px"> '.($dirc_1->family_name != ''? $dirc_1->family_name : '').'</td>
        </tr>
       </table>
    </td>
</tr>

<tr style="">
   <td><table >
        <tr>
          <td>Date of birth (DD/MM/YYYY)</td> <td>Australian Tax File Number</td> <td>Country of Birth / Citizenship</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2"> 
        <tr>
          <td border="1px"> '.($dirc_1->date_of_birth != '' ? date('d M, Y', strtotime($dirc_1->date_of_birth)) : '').'</td>
          <td border="1px"> '.($dirc_1->aus_tax_file_no != ''? $dirc_1->aus_tax_file_no : '').'</td> 
          <td border="1px"> '.($dirc_1->country != ''? $dirc_1->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td>Street Number & Name or PO Box:</td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td> '.($dirc_1->resident_address != ''? $dirc_1->resident_address : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Suburb</td> <td>State</td> <td>Postcode</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($dirc_1->suburb != ''? $dirc_1->suburb : '').'</td> 
          <td border="1px"> '.($dirc_1->state != ''? $dirc_1->state : '').'</td> 
          <td border="1px"> '.($dirc_1->postcode != ''? $dirc_1->postcode : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr>
   <td></td>
</tr>  
<tr>
   <td></td>
</tr>   
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>2. B) Individual 2</td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Title</td> <td>Given name(s)</td> <td>Surname</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($dirc_2->title != '' ? $dirc_2->title : '').'</td> 
          <td border="1px"> '.(($dirc_2->given_name != '') ? $dirc_2->given_name : '').'</td> 
          <td border="1px"> '.(($dirc_2->family_name != '') ? $dirc_2->family_name : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Date of birth (DD/MM/YYYY)</td> <td>Australian Tax File Number</td> <td>Country of Birth / Citizenship</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.(($dirc_2->date_of_birth != '') ? date('d M, Y', strtotime($dirc_2->date_of_birth)) : '').'</td> 
          <td border="1px"> '.(($dirc_2->aus_tax_file_no != '') ? $dirc_2->aus_tax_file_no : '').'</td> 
          <td border="1px"> '.(($dirc_2->country != '') ? $dirc_2->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td>Street Number & Name or PO Box:</td>
</tr>
<tr >
   <td><table border="1px"  cellpadding="2"><tr><td> '.(($dirc_2->resident_address != '') ? $dirc_2->resident_address : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Suburb</td> <td>State</td> <td>Postcode</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.(($dirc_2->suburb != '') ? $dirc_2->suburb : '').'</td> 
          <td border="1px"> '.(($dirc_2->state != '') ? $dirc_2->state : '').'</td> 
          <td border="1px"> '.($dirc_2->postcode != '' ? $dirc_2->postcode :'').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr>
   <td></td>
</tr>  

<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>2. D) Account Designation (if applicable)</td>
</tr>

<tr >
   <td><table >
        <tr>
          <td>If making this investment as an Individual Trustee(s) on behalf of another person(s), please provide that person(s) name as an account designation.</td>
        </tr>
       </table>
    </td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2">
        <tr>
          <td></td> 
        </tr>
       </table>
    </td>
</tr>
</table>
<h3>Identification Documentation - Individuals:</h3>
<p>The ‘Anti-Money Laundering and Counter Terrorism Financing (AML/CTF)’ legislation obliges us to collect identification documents and other supporting information from our investors. The AML/CTF documentation required for processing this Application Form is outlined below. You must attach the following CERTIFIED copies of documents to this Application Form:</p>
<hr/>
<p>Please indicate which one you are providing:</p>
';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $text2a, 0, 1, 0, true, '', true);
// ---------------------------------------------------------
$pdf->CheckBox('aust', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'An Australian driver’s licence containing a photograph of the person');
$pdf->ln(10);
$pdf->CheckBox('aus_pass', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'An Australian passport');
$pdf->ln(10);
$pdf->CheckBox('id_card', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'An identification card issued by a state or territory that contains the date of birth');
$pdf->ln(4);
$pdf->Cell(5,5,'');
$pdf->Cell(10, 5, 'and a photograph of the card holder');
$pdf->ln(10);
}
else if($investor_detail->account_type == 2) { 
// Section 3
$test_3 = '
<hr/>
<table cellpadding="3">
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:gray;color:white;padding:5px;height:20px;">
   <td>Section 3. Company / Corporate Trustee</td>
</tr>  
<tr >
   <td></td>
</tr>
<tr >
   <td>Complete this section if you are a Company, or a Company acting as a Trustee for a Trust/Fund.</td>
</tr>

<tr >
   <td>The AML/CTF documentation required for the processing of this Application Form is outlined on Page 4.</td>
</tr>
<tr >
   <td></td>
</tr>
</table>
';
$pdf->writeHTMLCell(0, 0, '', '', $test_3, 0, 1, 0, true, '', true);
$pdf->CheckBox('pub_com', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'Public Company');
$pdf->ln(5);
$pdf->CheckBox('aus_com', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'Australian Proprietary Company');
$pdf->ln(5);

$text3_a = '
<table cellpadding="3">
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>3. A) Company Details</td>
</tr>

<tr style="">
   <td>Company name (in full)</td>
</tr>

<tr > 
   <td><table border="1px" cellpadding="2"><tr><td> '.($company->company_name != '' ? $company->company_name : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Contact name (at Company)</td> <td>Australian Tax File Number(s)</td> <td>ACN / ABN</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3"  cellpadding="2">
        <tr>
          <td border="1px"> '.($company->given_name != '' ? $company->given_name : '').'</td> 
          <td border="1px"> '.($company->aus_tas_file_no != '' ? $company->aus_tas_file_no : '').'</td> 
          <td border="1px"> '.($company->abn_no != '' ? $company->abn_no : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td>Registered address</td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td> '.($company->postal_address1 != '' ? $company->postal_address1 : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Suburb</td> <td>State</td> <td>Postcode</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($company->suburb != '' ? $company->suburb : '').'</td> 
          <td border="1px"> '.($company->state != '' ? $company->state : '').'</td> 
          <td border="1px"> '.($company->postal_code != '' ? $company->postal_code : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr>
    <td></td>
</tr>    
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>3. B) Account Designation / Reference</td>
</tr>
<tr style="">
   <td>Corporate margin lenders / nominees / custodians, should provide an account designation / reference</td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td></td></tr></table></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color: light gray;padding:5px;height:20px;">
   <td>3. D) Director Information</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><p><b>Proprietary companies to provide full name of each director of the Company</b></p></td>
</tr>
<tr >
   <td><table border="1px"  cellpadding="2"><tr><td> 1. '.($director_names[0] != '' ? $director_names[0] : '').'</td></tr></table></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td> 2. '.($director_names[1] != '' ? $director_names[1] : '').'</td></tr></table></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td> 3. '.($director_names[2] != '' ? $director_names[2] : '').'</td></tr></table></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td> 4. '.($director_names[3] != '' ? $director_names[3] : '').'</td></tr></table></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td> 5. '.($director_names[4] != '' ? $director_names[4] : '').'</td></tr></table></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td> 6. '.($director_names[5] != '' ? $director_names[5] : '').'</td></tr></table></td>
</tr>
<tr><td>If there are additional directors, please provide details as an attachment.</td></tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>3. E) Beneficial Owner of Information</td>
</tr>
<tr >
   <td>Proprietary companies, please provide details of each Beneficial Owner having more than 25% of the Company’s issued share capital:</td>
</tr>
<tr >
   <td><b>Beneficial Owner 1:</b></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Title</td> <td>Given name(s)</td> <td>Surname</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"></td> 
          <td border="1px">'.($benef_1->given_name != '' ? $benef_1->given_name : '').'</td> 
          <td border="1px">'.($benef_1->family_name != '' ? $benef_1->family_name : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Date of birth (DD/MM/YYYY)</td> <td>Australian Tax File Number</td> <td>Country of Birth / Citizenship</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"></td> 
          <td border="1px">'.($benef_1->aus_tax_file_no != '' ? $benef_1->aus_tax_file_no : '').'</td> 
          <td border="1px">'.($benef_1->country != '' ? $benef_1->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td>Street Number & Name or PO Box:</td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td>'.($benef_1->resident_address != '' ? $benef_1->resident_address : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Suburb</td> <td>State</td> <td>Postcode</td><td>Country</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px">'.($benef_1->suburb != '' ? $benef_1->suburb : '').'</td> 
          <td border="1px">'.($benef_1->state != '' ? $benef_1->state : '').'</td> 
          <td border="1px">'.($benef_1->postal_code != '' ? $benef_1->postal_code : '').'</td>
          <td border="1px">'.($benef_1->country != '' ? $benef_1->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr >
   <td><b>Beneficial Owner 2:</b></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Title</td> <td>Given name(s)</td> <td>Surname</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px" ></td> 
          <td border="1px" >'.($benef_2->given_name != '' ? $benef_2->given_name : '').'</td> 
          <td border="1px" >'.($benef_2->family_name != '' ? $benef_2->family_name : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Date of birth (DD/MM/YYYY)</td> <td>Australian Tax File Number</td> <td>Country of Birth / Citizenship</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"></td> 
          <td border="1px">'.($benef_2->aus_tax_file_no != '' ? $benef_2->aus_tax_file_no : '').'</td> 
          <td border="1px">'.($benef_2->country != '' ? $benef_2->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td>Street Number & Name or PO Box:</td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td>'.($benef_2->resident_address != '' ? $benef_2->resident_address : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Suburb</td> <td>State</td> <td>Postcode</td><td>Country</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px">'.($benef_2->suburb != '' ? $benef_2->suburb : '').'</td> 
          <td border="1px">'.($benef_2->state != '' ? $benef_2->state : '').'</td> 
          <td border="1px">'.($benef_2->postal_code != '' ? $benef_2->postal_code : '').'</td>
          <td border="1px">'.($benef_2->country != '' ? $benef_2->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr>
   <td><b>Beneficial Owner 3:</b></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Title</td> <td>Given name(s)</td> <td>Surname</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px" ></td> 
          <td border="1px" >'.($benef_3->given_name != '' ? $benef_3->given_name : '').'</td> 
          <td border="1px" >'.($benef_3->family_name != '' ? $benef_3->family_name : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Date of birth (DD/MM/YYYY)</td> <td>Australian Tax File Number</td> <td>Country of Birth / Citizenship</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"></td> 
          <td border="1px">'.($benef_3->aus_tax_file_no != '' ? $benef_3->aus_tax_file_no : '').'</td> 
          <td border="1px">'.($benef_3->country != '' ? $benef_3->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td>Street Number & Name or PO Box:</td>
</tr>
<tr >
   <td><table border="1px" cellpadding="2"><tr><td>'.($benef_3->resident_address != '' ? $benef_3->resident_address : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>Suburb</td> <td>State</td> <td>Postcode</td><td>Country</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px">'.($benef_3->suburb != '' ? $benef_3->suburb : '').'</td> 
          <td border="1px">'.($benef_3->state != '' ? $benef_3->state : '').'</td> 
          <td border="1px">'.($benef_3->postal_code != '' ? $benef_3->postal_code : '').'</td>
          <td border="1px">'.($benef_3->country != '' ? $benef_3->country : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr >
   <td></td>
</tr>
</table>
<p><b>Identification Documentation - Companies:</b></p>
<p>The ‘Anti-Money Laundering and Counter Terrorism Financing (AML/CTF)’ legislation obliges us to collect identification documents and other supporting information from our investors. The AML documentation required for the processing for Section 3 of this Application Form is outlined below. You must attach the following <b>CERTIFIED</b> copies of documents to this Application Form.</p>
<hr/>
<p><b>Australian Companies:</b></p>
';
$pdf->writeHTMLCell(0, 0, '', '', $text3_a, 0, 1, 0, true, '', true);
// Close and output PDF document
$pdf->ln(4);
$pdf->CheckBox('prop_c', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'If a proprietary company:');
$pdf->ln(4);
$pdf->Cell(10,5,'');
$pdf->Cell(20, 5, '• An ASIC Company Extract showing the company name, ACN, registered office');
$pdf->ln(4);
$pdf->Cell(10,5,'');
$pdf->Cell(2, 5, '  address, the names and addresses of the directors and shareholders; or');
$pdf->ln(10);

$pdf->CheckBox('p_c_2', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'If a public company:');
$pdf->ln(4);
$pdf->Cell(10,5,'');
$pdf->Cell(20, 5, '• An ASIC Company Extract showing the company name, ACN, registered office');
$pdf->ln(4);
$pdf->Cell(10,5,'');
$pdf->Cell(2, 5, '  address, the names and addresses of the directors;');
$pdf->ln(10);
// Section 4
}
else if($investor_detail->account_type > 2) {
$text4 = '
<hr/>
<table cellpadding="3">
<tr >
   <td></td>
</tr>
<tr style="background-color:gray;color:white;padding:5px;height:20px;">
   <td>4. Trust / Superannuation Fund</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Complete this section if you are a Trust / Superannuation Fund.</td>
</tr>
<tr >
   <td>The AML/CTF documentation required for processing this Application Form is outlined below.</td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>4. A) Trust / Superannuation Fund Details</td>
</tr>
<tr >
   <td></td>
</tr>

<tr style="">
   <td>Trust / Superannuation Fund name (in full)</td>
</tr>

<tr >
   <td><table border="1px" cellpadding="2"><tr><td> '.($trust->company_name != '' ? $trust->company_name : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>ABN (if applicable)</td> <td>Australian Tax File Number or Exemption Reason</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($trust->abn_no != '' ? $trust->abn_no : '').'</td> 
          <td border="1px"> '.($trust->aus_tas_file_no != '' ? $trust->aus_tas_file_no : '').'</td> 
        </tr>
       </table>
    </td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>4. B) Type of Trust</td>
</tr>
<tr >
   <td></td>
</tr>
</table>
';
$pdf->writeHTMLCell(0, 0, '', '', $text4, 0, 1, 0, true, '', true);
$pdf->CheckBox('aus_reg_trust', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'Australian Regulated Trust/Fund (e.g. self-managed superannuation fund) – Established ');
$pdf->ln(4);
$pdf->Cell(5,5,'');
$pdf->Cell(20, 5, 'in Australia and regulated by the Australian Taxation Office');
$pdf->ln(10);
}
$text4_d = <<<EOD
<table cellpadding="3">
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>4. D) Trustee Details – Individuals</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Details must be provided for <b>AT LEAST ONE</b> of the individuals appointed as Trustee for the Trust/Superannuation Fund. Please complete Section 2 of the Application Form.</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>4. E) Trustee Details – Company</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Please complete Section 3 of the form to provide details of the Corporate Trustee for the Trust.</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><b>Identification Documentation - Trusts/Superannuation Funds:</b></td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>The AML/CTF legislation obliges us to collect identification documents and other supporting information from our investors.
The AML documentation required for the processing for Section 4 of this Application Form is outlined below.</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>You must attach the following <b>CERTIFIED</b> copies of documents to this Application Form</td>
</tr>
<tr >
   <td></td>
</tr>
</table>
<hr/>
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $text4_d, 0, 1, 0, true, '', true);
// section 4 E
$pdf->ln(2);
$pdf->Cell(10,5,'For Self-Managed Funds');
$pdf->ln(5);
$pdf->CheckBox('copy_search_res', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'A copy of search results from ASIC or Relevant Regulator Website (e.g. Superfund');
$pdf->ln(4);
$pdf->Cell(5,5,'');
$pdf->Cell(20, 5, 'lookup at www.abn.business.gov.au)');
$pdf->ln(10);
$pdf->Cell(10,5,'For Other Trusts');
$pdf->ln(5);
$pdf->CheckBox('sol_quali_acc', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'A letter from a solicitor or qualified accountant that confirms the name of the trust, OR');
$pdf->ln(10);
$pdf->CheckBox('org_cert_copy', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'An original or certified copy of the trust deed or extract or equivalent, OR');
$pdf->ln(10);
$pdf->CheckBox('ato', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'A notice issued by the ATO within the last 12 months');
$pdf->ln(10);
$pdf->Cell(10,5,'Please also provide the following trustee information:');
$pdf->ln(5);
$pdf->CheckBox('indi_id_doc', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'If the trustee is an individual, please provide the identification documentation ');
$pdf->ln(4);
$pdf->Cell(5,5,'');
$pdf->Cell(20, 5, 'required for individuals (section 2)');
$pdf->ln(10);
$pdf->CheckBox('trus_comp_id', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'If the trustee is a company, please provide the identification documentation required ');
$pdf->ln(4);
$pdf->Cell(5,5,'');
$pdf->Cell(20, 5, 'for companies (section 3)');

$pdf->ln(8);
// section 5
$text_5 = '
<hr/>
<table cellpadding="3">
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>4. E) Trustee Details – Company</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>A minimum initial investment of <b>$500,000</b> applies to Melling Capital Management Dynamic Volatility Fund. This fund is only available tp Wholesale Investors as defined by section 761G of the Corporations Act 2001.</td>
</tr>

<tr style="">
   <td><table >
        <tr>
          <td>Please indicate the amount you wish to invest in. (Minimum initial investment is $500,000)</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table border="1px">
        <tr>
          <td> $'.($bank->investment_ammount != '' ? $bank->investment_ammount : '').'</td> 
        </tr>
       </table>
    </td>
</tr>
</table>
<p>Please indicate how your investment amount will be made:</p>
';
$pdf->writeHTMLCell(0, 0, '', '', $text_5, 0, 1, 0, true, '', true);
$pdf->ln(5);
$pdf->CheckBox('cheques_payable', 5, ($bank->cheaque == 1 ? true : false) , array(), array(), 'OK');
$pdf->Cell(35, 5, 'Cheque (made payable to: Melling Capital Management ATF Dynamic Volatility Fund ');
$pdf->ln(4);
$pdf->Cell(5,5,'');
$pdf->Cell(20, 5, 'Applications Account)');
$pdf->ln(10);
$pdf->CheckBox('eft', 5, ($bank->eft == 1 ? true : false), array(), array(), 'OK');
$pdf->Cell(35, 5, 'EFT / Direct Deposit (please refer to table below)');
$pdf->ln(10);
// Bank detail
$text_bank = <<<EOD
<table  cellspacing="3" cellpadding="3">

<tr>
  <th style="background-color: blue;color:white;">Fund:</th>
  <th style="background-color: blue;color:white;">Bank:</th>
  <th style="background-color: blue;color:white;">Account Name:</th>
  <th style="background-color: blue;color:white;">BSB:</th>
  <th style="background-color: blue;color:white;">Account Number:</th>
</tr>
<tr>
  <td style="background-color:light gray;">Melling Capital Management Dynamic Volatility Fund</td>
  <td style="background-color:light gray;">National Australia Bank</td>
  <td style="background-color:light gray;">Melling Capital Management Pty Ltd ATF Dynamic Volatility Fund Applications Account</td>
  <td style="background-color:light gray;">082-401</td>
  <td style="background-color:light gray;">24-541-1027</td>
</tr>
</table>
<table cellpadding="3">
<tr >
   <td></td>
</tr>
<tr >
   <td>Please note – Application monies paid by cheque will become available as cleared funds three business days after they are debited from your account unless dishonoured by your financial institution. Units in a Melling Capital Management Fund will be issued following receipt of a valid Application Form, Investor Identification documents and cleared funds.</td>
</tr>

<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>5. C) Distribution Re-Investment</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Please indicate how you would like to receive fund distributions</td>
</tr>
</table>
EOD;
$pdf->writeHTMLCell(0, 0, '', '', $text_bank, 0, 1, 0, true, '', true);
$pdf->ln(5);
$pdf->CheckBox('ad_hni_melling', 5, ($distribution_reinvestment == 1 ? true : false), array(), array(), 'OK');
$pdf->Cell(35, 5, 'Reinvest in additional units in the Melling Capital Management Dynamic Volatility Fund ');
$pdf->ln(7);
$pdf->CheckBox('accnt_finac', 5, ($bank->paid_cash == 1 ? true : false ), array(), array(), 'OK');
$pdf->Cell(35, 5, 'Paid in cash to my/our account (Please provide your financial institution account details');
$pdf->ln(4);
$pdf->Cell(5,5,'');
$pdf->Cell(20, 5, ' in Part 5.D).');
$pdf->ln(10);
// Section 5D
$text5_d = '
<p style="font-size:10px;">If no election is made distributions will be re-invested. Your distribution election will apply to your entire unitholding in Melling Capital Management Dynamic Volatility Fund and cannot apply to only part of your holding. The Manager may suspend or discontinue distribution re-investment in its discretion.</p> 
<table cellpadding="3">
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>5. D) Financial Institution Account Details</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Please provide account details for the credit of withdrawals, credit of distributions (if nominated in Part 5.C).</td>
</tr>

<tr>
   <td><b>Account Details</b></td>
</tr>
<tr style="">
   <td>Name of Financial Institution</td>
</tr>

<tr >
   <td><table border="1px" cellpadding="2"><tr><td> '.($bank->bank_name != '' ? $bank->bank_name : '').'</td></tr></table></td>
</tr>
<tr style="">
   <td><table >
        <tr>
          <td>BSB Number</td> <td>Account Number(s)</td> <td>Account Name</td>
        </tr>
       </table>
    </td>
</tr>
<tr style="">
   <td><table  cellspacing="3" cellpadding="2">
        <tr>
          <td border="1px"> '.($bank->bsb != '' ? $bank->bsb : '').'</td> 
          <td border="1px"> '.($bank->acc_no != '' ? $bank->acc_no : '').'</td> 
          <td border="1px"> '.($bank->acc_name != '' ? $bank->acc_name : '').'</td>
        </tr>
       </table>
    </td>
</tr>
<tr >
   <td>
      <table >
        <tr>
         <td>Signature</td><td>Signature</td>
        </tr>
      </table>
    </td>     
</tr>
<tr >
   <td><table cellspacing="3" cellpadding="10">
     <tr>
        <td border="1px"></td>
        <td border="1px"></td>
     </tr>
     </table>
  </td>
</tr>
<tr style="">
      <td>
      <table >
        <tr>
         <td>Date</td><td>Date</td>
        </tr>
      </table>
    </td> 
</tr>
<tr >
   <td><table cellspacing="3" cellpadding="2">
     <tr>
        <td border="1px">'.($bank->date != '' ? date('d M, Y', strtotime($bank->date)) : '').'</td>
        <td border="1px">'.($bank->date != '' ? date('d M, Y', strtotime($bank->date)) : '').'</td>
     </tr>
     </table>
  </td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>5. F) Adviser Details</td>
</tr> 
<tr >
   <td></td>
</tr>

<tr style="">
      <td>
      <table >
        <tr>
         <td>Adviser Name</td><td>Adviser Code</td><td>Entry Fee (max 1%)</td>
        </tr>
      </table>
    </td> 
</tr>

<tr >
   <td><table cellspacing="3" cellpadding="2">
     <tr>
        <td border="1px"> '.($advisor->full_name != '' ? $advisor->full_name : '').'</td>
        <td border="1px"> '.($advisor->advisor_code != '' ? $advisor->advisor_code : '').'</td>
        <td border="1px"> '.($advisor->ongoing_service != '' ? $advisor->ongoing_service : '').'</td>
     </tr>
     </table>
  </td>
</tr>
</table>
<p>My client’s investor identification documentation is attached:</p>
<p>Please provide with this Application Form CERTIFIED COPIES of the identification documentation specified in the AML section under
The relevant investor type.</p>
<br/><br/><br/><br/>
<p>____________________</p>
<p>Adviser Signature</p>
<table>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>6. G) Declaration and Signatures</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>I/we declare and agree that:</td>
</tr>
</table>
<ul>
<li>All details in this Application Form are true and correct;</li>
<li>I/we have received and have read, or have had the opportunity to read, the current Information Memorandum (IM) to which this Application Form applies and agree to be bound by the provisions of the IM (as amended from time to time) governing the Melling Capital Management Dynamic Volatility Fund. This Application Form does not form a part of the IM;</li>
<li>I/we am/are an individual over 18 years of age, or I am a duly incorporated body;</li>
<li>If this Application Form is signed under Power of Attorney, the Attorney declares that he/she has not received notice of revocation of that power (a certified copy of the Power of Attorney should be submitted with this Application Form);</li>
<li>If signing on behalf of a company as a sole signatory, that I am signing as a sole director and sole secretary of the company; and</li>
<li>If investing as trustee, on behalf of a superannuation fund or trust, that I/we am/are acting in accordance with my/our designated powers and authority under the applicable trust deed. In the case of a superannuation fund, I/we also confirm that it is a complying fund under the Superannuation Industry (Superannuation) Act 1993.</li>
<li><b>I/we will NOT hold units on behalf of a US taxpayer</b></li>
</ul>
<p>I/we acknowledge that:</p>
<ul>
<li>Neither the Manager, its related bodies corporate or associates nor any other person guarantees the repayment of capital or the performance of the Funds or any particular rate of return from the Funds;</li>
<li>Unit holdings are subject to investment risks, including loss of income and principal invested and possible delays in repayment;</li>
<li>The Manager is authorised to apply the TFN or ABN provided and it will be applied to all future applications for Units, including reinvestments, unless I/we advise the Manager otherwise;</li>
<li>The Manager reserves the right to not accept any Application Form in its absolute discretion;</li>
<li>If my/our Application Form is incomplete or monies are dishonoured, the Manager will not process my/our Application Form and will notify me/us. I acknowledge that a completed Application Form comprises a valid Application Form, Investor Identification Documentation and cleared Funds in the Manager’s Bank Account;</li>
<li>I/we have read the information on privacy and personal information contained in the IM and consent to my/our personal information being collected, used and disclosed in accordance with the IM and the Manager’s Privacy Policy;</li>
<li>Application monies will be held in a bank account until invested in the Fund or returned to me/us. Any interest paid on that account will be paid to the Manager and not to applicants regardless of whether their Application Form is not successful;</li>
<li>Investments in the Funds are subject to investment risk, including possible delays in repayment and loss of income and capital invested. None of the Manager or related bodies corporate, affiliates, associates or officers of any of the above entities guarantees any particular rate of return or the performance of the Funds, nor do they guarantee repayment of capital from the Funds; and</li>
<li>Investments in the Funds are not deposits with or other liabilities of the Manager or related bodies corporate, affiliates, associates or officers of any of the above entities.</li>
</ul>
<p>I/we warrant that:</p>
<ul>
<li>I/we will comply and will continue to comply with applicable anti-money laundering and counter-terrorism financing laws and regulations, including but not limited to the law and regulations of Australia in force from time to time (AML/CTF Law);</li>
<li>I/we am/are not aware and have no reason to suspect that the moneys used to fund my/our investment have been or will be derived from or related to any money laundering, terrorism financing or similar activities illegal under applicable laws or regulations (‘illegal activity’); or that the proceeds of my/our investment in a Fund will be used to finance any illegal activities</li>
<li>I/we will provide the Manager with all additional information and assistance the Manager may request in order for it to comply with any AML/CTF Law; and</li>
<li>I/we am/are not a ‘politically exposed’ person or organisation for the purposes of any AML/CTF Law.</li>

</ul>
<table cellpadding="3">

<tr >
   <td></td>
</tr>

<tr style="">
      <td>
      <table >
        <tr>
         <td >Name of Investor 1:</td><td>Name of Investor 2 (If Joint Investors, both MUST sign)</td>
        </tr>
      </table>
    </td> 
</tr>

<tr >
   <td><table cellspacing="3" cellpadding="2">
     <tr>     
        <td border="1px"> '.($investor_detail->given_name != '' ? $investor_detail->given_name : '').'</td>
        <td border="1px"> '.($investor2_detail->given_name != '' ? $investor2_detail->given_name : '').'</td>
     </tr>
     </table>
  </td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="">
      <td>
      <table >
        <tr>
         <td>Signature of Investor 1:</td><td>Signature of Investor 2</td>
        </tr>
      </table>
    </td> 
</tr>

<tr >
   <td><table cellspacing="3" cellpadding="10">
     <tr>
        <td border="1px"></td>
        <td border="1px"></td>
     </tr>
     </table>
  </td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="">
      <td>
      <table >
        <tr>
         <td>Title of Signatory: eg Director, Trustee, Power of Attorney</td><td>Title of Signatory: eg Director, Trustee, Power of Attorney</td>
        </tr>
      </table>
    </td> 
</tr>

<tr >
   <td><table cellspacing="3" cellpadding="2">
     <tr>
        <td border="1px"></td>
        <td border="1px"></td>
     </tr>
     </table>
  </td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="">
      <td>
      <table >
        <tr>
         <td>Date</td><td>Date</td>
        </tr>
      </table>
    </td> 
</tr>

<tr >
   <td><table cellspacing="3" cellpadding="2">
     <tr>
        <td border="1px"></td>
        <td border="1px"></td>
     </tr>
     </table>
  </td>
</tr>
<tr><td style="font-size:10px;">If there are more than 2 signatories please include an attached list of names and signatures.</td></tr>
</table>
<p>Number of signatories required to instruct on this investment:</p>
';
$pdf->writeHTMLCell(0, 0, '', '', $text5_d, 0, 1, 0, true, '', true);
$pdf->ln(5);
$pdf->Cell(5, 5, '1');
$pdf->CheckBox('sig_1', 5, false, array(), array(), 'OK');
$pdf->Cell(10, 5, ' ');
$pdf->Cell(5, 5, '2');
$pdf->CheckBox('sig_2', 5, false, array(), array(), 'OK');
$pdf->Cell(15, 5, ' ');
$pdf->Cell(15, 5, 'Other');
$pdf->CheckBox('sig_other', 5, false, array(), array(), 'OK');
$pdf->ln(7);
$text_after_6G = <<<EOD

<table cellpadding="3">
<tr><td></td><td></td><td></td><td></td></tr>
<tr> 
  <td>
     <table >
     <tr>
        <td >please specify:</td>
     </tr>
     </table>
  </td>
  <td colspan="3"><table cellspacing="3" cellpadding="2">
     <tr>
        <td border="1px"  rowspan="3" ></td>
     </tr>
     </table>
  </td>
</tr>
</table>
<table cellpadding="3">
<tr >
   <td></td>
</tr>
<tr style="background-color: gray;color:white;padding:5px;height:20px;">
   <td>  Where do I send my Application Form?</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Completed Application Forms, cheques (where applicable) and identification documentation (where applicable) should be mailed to:</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td><b>FundBPO – Unit Registry <br/>
GPO Box 4968 <br/>
Sydney, NSW 2001 <br/>
AUSTRALIA </b>
</td>
</tr>
<tr >
   <td></td>
</tr>
<tr style="background-color:light gray;padding:5px;height:20px;">
   <td>  Where do I send my Application Form?</td>
</tr>
<tr >
   <td></td>
</tr>
<tr >
   <td>Use the below checklist to ensure you have provided us with a complete Application Form:</td>
</tr>
</table>
EOD;

$pdf->writeHTMLCell(0, 0, '', '', $text_after_6G, 0, 1, 0, true, '', true);
$pdf->ln(7);
$pdf->CheckBox('rel_sectio_app', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'Completed ALL relevant sections of the Application Form (according to your Investor');
$pdf->ln(5);
$pdf->Cell(5,5,'');
$pdf->Cell(20, 5, ' Type – outlined on page 1).');
$pdf->ln(10);
$pdf->CheckBox('info_memo', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'Read the Information Memorandum');
$pdf->ln(10);
$pdf->CheckBox('c_id_doc_enclosed', 5, false, array(), array(), 'OK');
$pdf->Cell(35, 5, 'Enclosed the certified identification documentation');
$pdf->ln(4);
// This method has several options, check the source code documentation for more information.
$id = $_SESSION['account_owner_id'];
$pdf->Output('MCM_DVF_Application_Form.pdf', 'D');
/*
//$pdf->Output($_SERVER['DOCUMENT_ROOT'].'/tcpdf/examples/pdf_reports/report_'.$id.'_'.time().'.pdf', 'F');
$_SESSION['report_name'] = 'report_'.$id.'_'.time().'.pdf';
//echo realpath(dirname(__FILE__));
$pdf->Output(realpath(dirname(__FILE__)).'/pdf_reports/report_'.$id.'_'.time().'.pdf', 'F');
// last url save in session
$_SESSION['last_url'] = $_SERVER['HTTP_REFERER'];
header('location:../../PHPMailer/examples/gmail.php'); */
//============================================================+
// END OF FILE
//============================================================+
