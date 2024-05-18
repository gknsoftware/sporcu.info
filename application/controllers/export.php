<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Export extends CI_Controller {
 
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
    protected $lisance_pure;
    protected $expBirth;
    protected $age;
    protected $parent_signature;

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
        $this->lisance = $this->model_user->get_student_info($this->uri->segment(3), 'lisance');
        $this->lisance_pure = $this->model_user->get_student_info($this->uri->segment(3), 'lisance');
        $this->nowYear = date('Y');

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

        //Check age
        $this->age = date('Y') - $this->expBirth[2];
        if ( $this->age < 18 )
        {
          $this->parent_signature = '<tr><td width="99%" height="50" style="border:1px solid #000;text-align:center;"><br /><br />
                    <span style="text-align:center;">
                      <span style="font-weight:bold;">'.$this->newGender.' '.$this->name.' '.$this->surname.'</span><br />
                      <span style="font-weight:bold;">'.$this->club_name.' NDE</span><br />
                      Spor yapmasına ve lisans çıkarılmasına Muvafakat ediyorum.
                    </span>

                     <br /><br />
                     <table width="600" cellspacing="0" cellpadding="0" style="display:block">
                     <tr>
                      <td align="center">VELİSİ</td>
                      <td align="center">BABA-ANNE</td>
                      <td align="center">İMZA</td>
                     </tr>
                     </table>
                    <br />
                    </td></tr>';

          $this->scholl_information = 'Okul';
        }
        else
        {
           $this->parent_signature = '<tr><td width="99%" height="50" style="border:1px solid #000;text-align:center;"><br /><br />
                    <span style="text-align:center;">
                      <span style="font-weight:bold;">OĞLUMUN-KIZIMIN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KULÜBÜNDE</span><br />
                      Spor yapmasına ve lisans çıkarılmasına Muvafakat ediyorum.
                    </span>

                     <br /><br />
                     <table width="600" cellspacing="0" cellpadding="0" style="display:block">
                     <tr>
                      <td align="center">VELİSİ</td>
                      <td align="center">BABA-ANNE</td>
                      <td align="center">İMZA</td>
                     </tr>
                     </table>
                    <br />
                    </td></tr>';

          $this->scholl_information = 'İş';
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
    $pdf->SetFont('timesnewroman', '', 14, '', false);   
 
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
            <div style="text-align:center;font-size:26px;">
              <strong>T.C.</strong><br />
              <strong>BAŞBAKANLIK</strong><br />
              <strong>GENÇLİK VE SPOR GENEL MÜDÜRLÜĞÜ</strong><br />
              <strong>Spor Teşekkülü Üyelerine Mahsus Tescil Fişi</strong>
            </div>
            <table width="100%" border="0" cellpadding="2" cellspacing="2">
              <tbody>
                <tr>
                  <td width="36%" height="185">&nbsp;&nbsp;İLİ: <strong><u>ANKARA</u></strong>
                    <p><strong>&nbsp;&nbsp;T.C KİMLİK NO :</strong></p>
                    <p>&nbsp;&nbsp;$this->tcno</p>
                    <p><strong><u>&nbsp;&nbsp;SPORCUNUN</u></strong></p>
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
                  <td>Adı</td>
                  <td>:</td>
                  <td>$this->name</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Soyadı</td>
                  <td>:</td>
                  <td>$this->surname</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Baba Adı</td>
                  <td>:</td>
                  <td>$this->father</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Anne Adı</td>
                  <td>:</td>
                  <td>$this->mother</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Doğum Yeri / İli ve İlçesi</td>
                  <td>:</td>
                  <td>$this->birthplace</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Doğum Tarihi/gün.ay.yıl</td>
                  <td>:</td>
                  <td>$this->birthdate</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4"><strong>I . Türk Tabiiyetinde İse</strong></td>
                </tr>
                <tr>
                  <td>Nüfusa Kayıtlı Olduğu</td>
                  <td>:</td>
                  <td>$this->population_county</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>İli / ilçe</td>
                  <td>:</td>
                  <td>$this->population_town</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>Mahalle / köy</td>
                  <td>:</td>
                  <td>$this->population_village</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="4" style="padding-top: 10px;"><strong><u>NÜFUS CÜZDANI</u></strong></td>
                </tr>
                <tr>
                  <td>Cilt No</td>
                  <td>:</td>
                  <td >$this->skin_no</td>
                  <td ROWSPAN="5" align="right"> <img width="300%" src="third/assets/images/sporcuimzasi.png" /></td>
                </tr>
                <tr>
                  <td>Aile sıra no</td>
                  <td>:</td>
                  <td>$this->family_no</td>
                </tr>
                <tr>
                  <td>Hane no</td>
                  <td>:</td>
                  <td>$this->house_no</td>
                </tr>
                <tr>
                  <td>Veriliş tarihi</td>
                  <td>:</td>
                  <td>$this->date_of_issue</td>
                </tr>
                <tr>
                  <td>Verildiği yer</td>
                  <td>:</td>
                  <td>$this->place_of_issue_town</td>
                </tr>
                <tr>
                  <td colspan="4" style="padding-top: 10px;"><strong>II .Yabancı Tabiiyetinde İse</strong></td>
                </tr>
                <tr>
                   <td colspan="4">Pasaport veya İkametgah<br />Tezkeresinin Tarihi ve Numarası:</td>
                </tr>
              </tbody>
            </table></td>
        </tr>    
        <tr>
          <td width="50%" style="border:1px solid #000;text-align:center;font-weight:bold;">
           Kulübümüzün Üyesi<br />Kulüp Başkanlığı<pre>/     /$this->nowYear</pre>
          </td>
          <td width="50%" style="border:1px solid #000;text-align:center;font-weight:bold;">
            İl Başkanlığı<br />Onayı<pre>/     /$this->nowYear</pre>
          </td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </tbody>
    </table>
    </body>
    </html>
EOD;


//Page 2
   $html2 = <<<EOD
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
                  <td width="99%" style="border:1px solid #000;text-align:center;font-weight:bold;font-size:36px;"><br />SPORCUNUN</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="99%" style="border:1px solid #000;text-align:left;font-weight:normal;"><br /><br />&nbsp;&nbsp;<span style="font-weight:bold">Adresi:</span> $this->address<br /></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="99%" style="border:1px solid #000;text-align:left;font-weight:normal;"><br /><br />&nbsp;&nbsp;<span style="font-weight:bold">Telefon:</span> $this->newFormatMobile<br /></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="99%" style="border:1px solid #000;text-align:left;font-weight:normal;"><br /><br />&nbsp;&nbsp;<span style="font-weight:bold">Mesleği:</span> $this->job<br /></td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="99%" style="border:1px solid #000;text-align:left;font-weight:normal;"><br /><br />&nbsp;&nbsp;<span style="font-weight:bold">$this->scholl_information Bilgileri:</span> $this->office<br /></td>
                </tr>
                <tr>
                  <td width="99%" height="50" style="border:1px solid #000;text-align:left;font-weight:normal;">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                   $this->parent_signature
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="99%" height="50" style="border:1px solid #000;text-align:center;font-weight:bold;">
                  <br /><br />
                  Kulüp Başkanlığı<br />
                  Mühür - imza
                  <br />
                  </td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="99%" style="border:1px solid #000;text-align:left;"><br />&nbsp;&nbsp;<span style="font-weight:bold;">KAN GRUBU:</span> $this->blood</td>
                </tr>
                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td width="99%" colspan="4" style="border:1px solid #000;text-align:left;">
                  <br />
                  T.C Başbakanlık Gençlik ve Spor Genel Müdürlüğünün 14.10.2008 tarih ve 2008 / 08 sayılı Genelgesine istinaden , düzenlenen lisans formunda meslek ile İşyeri ünvanı ve adresi bilgilerinin belirtilmesi zorunludur. 
                  </td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </tbody>
    </table>
    </body>
    </html>
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

    public function registerForm($student_id)
    {
        require_once('kayitformu.php');
    }
}
 
/* End of file export.php */
/* Location: ./application/controllers/export.php */