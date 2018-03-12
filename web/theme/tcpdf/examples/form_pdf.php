<?php @session_start();

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

//include_once('../../config.php');
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
    $this->Cell(0, 0, 'Report | Passport Management System', 0, true, 'L', 0, '', 1, false, 'C', 'M');

    
  }
  public function Header() {
  }
  public function Footer22() {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    $this->ln(4);
    $this->Cell(0, 0, 'Report | Passport Management System', 0, true, 'L', 0, '', 1, false, 'T', 'M');
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
$pdf->AddPage('L', 'A4');
$pdf->SetDisplayMode('default', 'SinglePage', 'UseNone');

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
// top header
// Img
//   DATA
$report_data = $_SESSION['report_data'];
$img = <<<EOD
<img src="way_to_arfa.png" style="width:100px; color:black;"/>
EOD;
$pdf->writeHTMLCell(0, 0, '5', '5', $img, 0, 1, 0, true, '', true);
// Registration form and reg no #
$top_reg_form = <<<EOD
<h3>Passport Report </h3>   
EOD;
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '125', '25', $top_reg_form, 0, 1, 0, true, '', true);
$top_reg_no = 
'<h6>Date : '.(date('d M, Y')).'</h6>  '; 
$pdf->writeHTMLCell(0, 0, '230', '5', $top_reg_no, 0, 1, 0, true, '', true);
if($_SESSION['report_start_date'])
{
	$top_values = '<h6>From : '.$_SESSION['report_start_date'].'</h6>  '; 
	$pdf->writeHTMLCell(0, 0, '230', '10', $top_values, 0, 1, 0, true, '', true);
}
if($_SESSION['report_end_date'])
{
	$top_values = '<h6>To : '.$_SESSION['report_end_date'].'</h6>  '; 
	$pdf->writeHTMLCell(0, 0, '230', '15', $top_values, 0, 1, 0, true, '', true);
}
if($_SESSION['report_pass_type'] != 0)
{
	$top_values = '<h6>Passport Type : '.($_SESSION['report_pass_type'] == 1 ? 'Inbound' : 'Outbound'); 
	$pdf->writeHTMLCell(0, 0, '230', '25', $top_values, 0, 1, 0, true, '', true);
}
if($_SESSION['report_agent'] != '')
{
	$top_values = '<h6>Agent : '.($_SESSION['report_agent']); 
	$pdf->writeHTMLCell(0, 0, '230', '35', $top_values, 0, 1, 0, true, '', true);
}

// Image wrapper
// Test Conducted
$pdf->ln(15);
$text3 = '<table cellpadding="3" border="0.5" style="font-size:11px;">
     <tr style="background-color:light gray;">
        <th width="30px;">Sr No.</th>
		<th width="100px;">Given Name</th>
		<th width="90px;">Surname</th>
		<th width="50px;">Gender</th>
		<th width="70px;">Passport No #</th>
		<th width="80px;">Expire Date</th>
		<th width="100px;">Mahrem</th>
		<th width="90px;">Relation</th>
		<th width="60px;">Visa Status</th>
		<th width="60px;">Passport Status</th>
		<th>Date</th>
		
	  </tr>
      '.$report_data.'
 </table>';

$pdf->writeHTMLCell(0, 0, '', '', $text3, 0, 1, 0, true, '', true);



// Section 2 : A

// ---------------------------------------------------------



// Section 3


//$pdf->writeHTMLCell(0, 0, '50', '50', $img, 0, 1, 0, true, '', true);

// This method has several options, check the source code documentation for more information.
//$id = $_SESSION['account_owner_id'];
$pdf->Output('passports_report.pdf', 'D');
  
// last url save in session
//$_SESSION['last_url'] = $_SERVER['HTTP_REFERER'];
//header('location:http://www.cts.org.pk/demo/admin/test/list'); 
//============================================================+
// END OF FILE
//============================================================+
