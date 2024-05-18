<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Printpdf extends CI_Controller {

    protected $html;
 
    protected $output;
    protected $tcno;
    protected $ns;
    protected $name;
    protected $surname;
    protected $mother;
    protected $father;
    protected $skin_no;
    protected $family_no;
    protected $house_no;
    protected $birthdate;
    protected $date_of_issue;
    protected $club_name;
    protected $branch_name;
    protected $birthplace;
    protected $population_county;
    protected $population_town;
    protected $population_village;
    protected $pic;
    protected $nowYear;
    protected $job;
    protected $address;
    protected $mobile;
    protected $school;
    protected $newFormatMobile;
    protected $gender;
    protected $newGender;
    protected $blood;
    protected $office;

    function __construct()
    {
        parent::__construct();

        //Load pdf library
        $this->load->library("Export_Data");
        $this->load->model('model_user','model_user',true);

        //Assing default var
        $this->tcno = $this->uri->segment(4);
        $this->ns = $this->uri->segment(5);

        //Assign user data
        $this->name = mb_strtoupper($this->model_user->get_student_info($this->uri->segment(3), 'name'), 'utf-8');
        $this->surname = mb_strtoupper($this->model_user->get_student_info($this->uri->segment(3), 'surname'), 'utf-8');
        $this->mother = mb_strtoupper($this->model_user->get_student_info($this->uri->segment(3), 'mother'), 'utf-8');
        $this->father = mb_strtoupper($this->model_user->get_student_info($this->uri->segment(3), 'father'), 'utf-8');
        $this->skin_no = $this->model_user->get_student_info($this->uri->segment(3), 'skin_no');
        $this->family_no = $this->model_user->get_student_info($this->uri->segment(3), 'family_order_no');
        $this->house_no = $this->model_user->get_student_info($this->uri->segment(3), 'house_no');
        $this->birthdate = $this->model_user->get_student_info($this->uri->segment(3), 'birthdate');
        $this->date_of_issue = $this->model_user->get_student_info($this->uri->segment(3), 'date_of_issue');
        $this->club_name = mb_strtoupper($this->model_user->get_club_name($this->model_user->get_student_info($this->uri->segment(3), 'club'), 'club_name'), 'utf-8');
        $this->branch_name = mb_strtoupper($this->model_user->get_branch_name($this->model_user->get_student_info($this->uri->segment(3), 'branch'), 'branch_name'), 'utf-8');
        $this->birthplace = mb_strtoupper($this->model_user->get_single_county($this->model_user->get_student_info($this->uri->segment(3), 'county')), 'utf-8');
        $this->population_county = mb_strtoupper($this->model_user->get_single_county($this->model_user->get_student_info($this->uri->segment(3), 'population_county')), 'utf-8');
        $this->population_town = mb_strtoupper($this->model_user->get_single_town($this->model_user->get_student_info($this->uri->segment(3), 'population_town')), 'utf-8');
        $this->population_village = mb_strtoupper($this->model_user->get_student_info($this->uri->segment(3), 'population_village'), 'utf-8');
        $this->place_of_issue_town = mb_strtoupper($this->model_user->get_single_town($this->model_user->get_student_info($this->uri->segment(3), 'place_of_issue_town')), 'utf-8');
        $this->pic = $this->model_user->get_student_info($this->uri->segment(3), 'picture');
        $this->job = $this->model_user->get_student_info($this->uri->segment(3), 'job');
        $this->address = $this->model_user->get_student_info($this->uri->segment(3), 'address');
        $this->mobile = $this->model_user->get_student_info($this->uri->segment(3), 'mobile');
        $this->school = $this->model_user->get_student_info($this->uri->segment(3), 'office');
        $this->gender = $this->model_user->get_student_info($this->uri->segment(3), 'gender');
        $this->blood = $this->model_user->get_student_info($this->uri->segment(3), 'blood');
        $this->office = $this->model_user->get_student_info($this->uri->segment(3), 'office');
        $this->nowYear = date('Y');

        //Phone
        $this->newFormatMobile = substr($this->mobile,0,4);
        $this->newFormatMobile .= ' '.substr($this->mobile,4,3);
        $this->newFormatMobile .= ' '.substr($this->mobile,7,2);
        $this->newFormatMobile .= ' '.substr($this->mobile,9,2);

        //Male or female
        $this->newGender = $this->gender == 0 ? 'OĞLUMUN' : 'KIZIMIN';

        //Output link
        $this->output = $this->uri->segment(4).'_'.$this->uri->segment(5).'.pdf';

        //HTML OUTPUT
        $this->html = '
        <span class="label label-info"><a href="'.route('printpdf').'">PDF</a></span>
        <div class="clearfix"></div>';
        foreach ($data as $k => $v) 
        {
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

          $returned .= '<div class="col-md-3 col-sm-6 col-xs-12 text-center">';
            if ( $v->picture == '0' ) :

              if ($v->gender == '0'):
                $returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
              else :
                $returned .= '<img src="'.get_asset('img', 'woman.png').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
              endif;
              
            else :
              
              $returned .= '<img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;text-align:center">';

            endif;

            $returned .= '<p style="padding-top: .8em;">';
              $returned .= $v->name.' '.$v->surname;
              $returned .= '<small style="display: block;">';
                $returned .= $v->gender==0 ? 'Erkek' : 'Kadın';
                $returned .=  " / ($age)";
                $returned .= '<br />'.$v->birthdate;
                $returned .=  '<br /><span class="label label-info">'.$this->model_user->get_branch_name($v->branch, 'branch_name').'</span>';
              $returned .= '</small>
            </p>
          </div>';
        }
        
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
    $this->html
EOD;
 
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);   
 
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