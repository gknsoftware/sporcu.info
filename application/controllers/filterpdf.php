<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filterpdf extends CI_Controller {

    protected $htmlRepeated;

    function __construct()
    {
        parent::__construct();

        //Load pdf library
        $this->load->library("Export_Data");
        $this->load->model('model_user','model_user',true);

        //Assing default var
        $this->group = $this->uri->segment(4);
        $this->filter = $this->uri->segment(3);


        $numR = count($this->model_user->student_filter_list($this->filter, rawurldecode($this->group)));
        $column = null;

        foreach ($this->model_user->student_filter_list($this->filter, rawurldecode($this->group)) as $k => $v)
        {
          $column++;

          //Explode data
          if ( strstr($v->birthdate,'/') ) {
            $expBirth = explode('/', $v->birthdate);
            $age = date('Y') - $expBirth[2];
          }
          elseif ( strstr($v->birthdate,'.') ) {
            $expBirth = explode('.', $v->birthdate);
            $age = date('Y') - $expBirth[2];
          }
          elseif ( strstr($v->birthdate,'-') ) {
            $expBirth = explode('-', $v->birthdate);
            $age = date('Y') - $expBirth[2];
          }

          $pic = str_replace(' ', '%20', $v->picture); 

          if ($column == 1) {
            $this->htmlRepeated .= '<tr>';
          }

          //######
          if ($age > 1) {
            
            # code...
            $this->htmlRepeated .= '<td><div>';
            if ( $v->picture == '0' ) {

              if ($v->gender == '0') {
                $this->htmlRepeated .= '<img src="'.get_asset('img', 'man.jpg').'" width="100" height="125" style="border: 1px solid #ccc; padding: 2px;text-align:center;">';
              }else {
                $this->htmlRepeated .= '<img src="'.get_asset('img', 'woman.png').'" width="100" height="125" style="border: 1px solid #ccc; padding: 2px;text-align:center;">';
              }
              
            }else {   
              $this->htmlRepeated .= '<img src="'.base_url().$pic.'" width="100" height="125" style="border: 1px solid #ccc; padding: 2px;text-align:center;">';
            }
            

            $this->htmlRepeated .= '<p style="padding-top: .8em; text-align:center">';
              $this->htmlRepeated .= $v->name.' '.$v->surname;
              $this->htmlRepeated .= '<br /><small style="display: block;">';
                $this->htmlRepeated .= $v->gender==0 ? 'Erkek' : 'Kadın';
                $this->htmlRepeated .=  " / ($age)";
                $this->htmlRepeated .= '<br />'.$v->birthdate;
                $this->htmlRepeated .=  '<br /><span class="label label-info">'.$this->model_user->get_branch_name($v->branch, 'branch_name').' '.$v->lisance.'</span>';
              $this->htmlRepeated .= '</small>
            </p>
          </div></td>';
        }
        //######

        if ($column == 4) {
          $this->htmlRepeated .= '</tr>';
          $column = 0;
        }
        }

        //Add tr
        if ($column == 2 || $column == 3) {
          $this->htmlRepeated .= '</tr>';
        }
        
        

        //Output link
        $this->output = $this->uri->segment(4).'_'.$this->uri->segment(5).'.pdf';
        
    }
 
    public function pdf() {
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
 
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

    // set margins
    $pdf->SetMargins(3, 5, PDF_MARGIN_RIGHT);  

    // set header & footer
    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
 
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);   
 
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE); 
 
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
    $pdf->SetFont('dejavusans', '', 10, '', true);   
 
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
 
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
 
    // Set some content to print
    $html = <<<EOD
    <table width="700" border="0" style="padding:25px 0;" cellspacing="3" cellpadding="3">
      <tbody>
       $this->htmlRepeated
      </tbody>
    </table>
EOD;
 
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
    // ---------------------------------------------------------    
 
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output($this->output, 'I');    
 
    //============================================================+
    // END OF FILE
    //============================================================+
    }
}
 
/* End of file export.php */
/* Location: ./application/controllers/export.php */