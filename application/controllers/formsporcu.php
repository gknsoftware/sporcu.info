<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Formsporcu extends CI_Controller {
 
    protected $id;
    protected $is_empty;
    protected $verticletext;
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
    protected $lisance;
    protected $expBirth;
    protected $age;
    protected $parent_signature;
    protected $email;
    protected $parent_1_name;
    protected $parent_1_email;
    protected $parent_1_mobile;
    protected $parent_1_newmobile;
    protected $parent_1_job;
    protected $parent_1_description;
    protected $parent_1_proximity;
    protected $parent_2_name;
    protected $parent_2_email;
    protected $parent_2_mobile;
    protected $parent_2_newmobile;
    protected $parent_2_job;
    protected $parent_2_description;
    protected $parent_2_proximity;

    function __construct()
    {
        parent::__construct();

        //Load pdf library
        $this->load->library("Export_Data");
        $this->load->model('model_user','model_user',true);

        //Assing default var
        $this->id = $this->uri->segment(3);
        $this->tcno = $this->uri->segment(4);
        $this->ns = $this->uri->segment(5);
        $this->is_empty = $this->uri->segment(6);

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
        $this->lisance = $this->model_user->get_student_info($this->uri->segment(3), 'lisance');
        $this->email = $this->model_user->get_student_info($this->uri->segment(3), 'email');
        $this->nowYear = date('Y');

        //Parent 1 information
        $this->parent_1_name = $this->model_user->get_parent_info($this->uri->segment(3), 1, 'name');
        $this->parent_1_email = $this->model_user->get_parent_info($this->uri->segment(3), 1, 'email');
        $this->parent_1_mobile = $this->model_user->get_parent_info($this->uri->segment(3), 1, 'mobile');
        $this->parent_1_job = $this->model_user->get_parent_info($this->uri->segment(3), 1, 'job');
        $this->parent_1_description = $this->model_user->get_parent_info($this->uri->segment(3), 1, 'description');
        $this->parent_1_proximity = $this->model_user->get_proximity_name( $this->model_user->get_parent_info($this->uri->segment(3), 1, 'proximity'), 'proximity' );
        // Phole
        $this->parent_1_newmobile = substr($this->parent_1_mobile,0,4);
        $this->parent_1_newmobile .= ' '.substr($this->parent_1_mobile,4,3);
        $this->parent_1_newmobile .= ' '.substr($this->parent_1_mobile,7,2);
        $this->parent_1_newmobile .= ' '.substr($this->parent_1_mobile,9,2);

        //Parent 2 information
        $this->parent_2_name = $this->model_user->get_parent_info($this->uri->segment(3), 2, 'name');
        $this->parent_2_email = $this->model_user->get_parent_info($this->uri->segment(3), 2, 'email');
        $this->parent_2_mobile = $this->model_user->get_parent_info($this->uri->segment(3), 2, 'mobile');
        $this->parent_2_job = $this->model_user->get_parent_info($this->uri->segment(3), 2, 'job');
        $this->parent_2_description = $this->model_user->get_parent_info($this->uri->segment(3), 2, 'description');
        $this->parent_2_proximity = $this->model_user->get_proximity_name( $this->model_user->get_parent_info($this->uri->segment(3), 2, 'proximity'), 'proximity' );
        // Phole 2
        $this->parent_2_newmobile = substr($this->parent_2_mobile,0,4);
        $this->parent_2_newmobile .= ' '.substr($this->parent_2_mobile,4,3);
        $this->parent_2_newmobile .= ' '.substr($this->parent_2_mobile,7,2);
        $this->parent_2_newmobile .= ' '.substr($this->parent_2_mobile,9,2);

        //Phone
        $this->newFormatMobile = substr($this->mobile,0,4);
        $this->newFormatMobile .= ' '.substr($this->mobile,4,3);
        $this->newFormatMobile .= ' '.substr($this->mobile,7,2);
        $this->newFormatMobile .= ' '.substr($this->mobile,9,2);

        //Male or female
        $this->newGender = $this->gender == 0 ? 'OĞLUM' : 'KIZIM';

        //Check lisance
        if ($this->lisance)
        {
          $this->lisance = '
          <strong><u>BRANŞ</u></strong> <br /><strong>'.$this->branch_name.'</strong>
          <p>&nbsp;</p><strong><u>LİSANS</u></strong><br />'.$this->lisance;
        }
        else
        {
          $this->lisance = '<p>&nbsp;</p><strong><u>BRANŞ</u></strong><br /><br /> <strong>'.$this->branch_name.'</strong>';
        }

        //Explode birthdate
        if ( strstr($this->birthdate,'/') ) {
          $this->expBirth = explode('/', $this->birthdate);
        }
        elseif ( strstr($this->birthdate,'.') ) {
          $this->expBirth = explode('.', $this->birthdate);
        }
        elseif ( strstr($this->birthdate,'-') ) {
          $this->expBirth = explode('-', $this->birthdate);
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
 
    $str_StudentTrainings = '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
    $all_trainings = $this->model_user->get_student_training_info($this->id);
    foreach ($all_trainings as $key => $value)
    {
        $str_StudentTrainings .= '<tr>';
        foreach ($this->model_user->get_training_list($value->training_id) as $_key => $_value)
        {
            
            @$plus++;

            $expDate = explode('-', $_value->date);

            $str_StudentTrainings .= '<th scope="row" width="10%"><strong>'.$plus.'</strong></th>';
            $str_StudentTrainings .= '<td>'.$expDate[2].' '.change_months($expDate[1]).' '.$expDate[0].'</td>';
            $str_StudentTrainings .= '<td>'.$_value->time.'</td>';
            $str_StudentTrainings .= '<td>'.$_value->training_name.'</td>';

        }
        $str_StudentTrainings .= '</tr>';
    }
    $str_StudentTrainings .= '</table>';
    
    $str_StudentTrainings = ($this->is_empty=='') ? $str_StudentTrainings : null;
      
    /**
    * Creates an example PDF TEST document using TCPDF
    * @package com.tecnick.tcpdf
    * @abstract TCPDF - Example: Default Header and Footer
    * @author Nicola Asuni
    * @since 2008-03-04
    */
 
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false); 

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
    $pdf->SetFont('timesnewroman', '', 10, '', false);   
 
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
 
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
 
    // Set some content to print
    $html = <<<EOD
    <!doctype html>
    <html>
    <head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    </head>

    <body>
    <table width="700" border="0" style="border:1px solid #000;">
      <tbody>
        <tr>
          <td colspan="2">
            <table width="100%" border="0" cellpadding="2" cellspacing="2">
              <tbody>
                <tr>
                  <td width="36%" height="185">
                    <p><strong> </strong></p>
                  </td>
                  <td width="2%">&nbsp;</td>
                  <td width="35%" align="center"><img src="$this->pic" width="135" height="175"></td>
                  <td width="27%" align="center">$this->lisance</td>
                </tr>
                <tr style="font-weight: bold;">
                  <td>KULÜBÜN ADI</td>
                  <td>:</td>
                  <td colspan="2">$this->club_name</td>
                </tr>
                
                <tr>
                  <td>T.C Kimlik No </td> <td>:</td> <td>$this->tcno</td><td>&nbsp;</td>
                </tr>

                <tr>
                  <td>Adı Soyadı</td>
                  <td>:</td>
                  <td>$this->name $this->surname</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Telefonu</td>
                  <td>:</td>
                  <td>$this->newFormatMobile</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>ePosta</td>
                  <td>:</td>
                  <td>$this->email</td>
                  <td>&nbsp;</td>
                </tr>                
                <tr>
                  <td>Mesleği</td>
                  <td>:</td>
                  <td>$this->job</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Kan Grubu</td>
                  <td>:</td>
                  <td>$this->blood</td>
                  <td>&nbsp;</td>
                </tr>  
                <tr>
                  <td>Baba Adı</td>
                  <td>:</td>
                  <td>$this->father</td>
                  <td>$this->parent_1_proximity <br />$this->parent_1_name / $this->parent_1_newmobile </td>
                </tr>
                <tr>
                  <td>Anne Adı</td>
                  <td>:</td>
                  <td>$this->mother</td>
                  <td>$this->parent_2_proximity <br />$this->parent_2_name / $this->parent_2_newmobile</td>
                </tr>
                <tr>
                  <td>Doğum Tarihi / Yeri - İli</td>
                  <td>:</td>
                  <td>$this->birthdate - $this->birthplace</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Adres</td>
                  <td>:</td>
                  <td>$this->address</td>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table></td>
        </tr>    
  
      </tbody>
    </table>
    
    
    <p>
        $str_StudentTrainings
    </p>
    </body>
    </html>
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