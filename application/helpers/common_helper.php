<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Europe/Moscow');

if (!function_exists('get_third'))
{
	function get_third($dir, $file)
	{
		return base_url().'third/'.$dir.'/'.$file;
	}
}

if (!function_exists('get_asset'))
{
	function get_asset($type, $file)
	{
		switch ($type) {
			case 'css':
				return base_url().'third/assets/css/'.$file;
				break;
			
			case 'js':
				return base_url().'third/assets/js/'.$file;
				break;
				
			case 'img':
				return base_url().'third/assets/images/'.$file;
				break;
		}
	}
}

if (!function_exists('route'))
{
    function route($url, $target = null)
    {
        if (!empty($target)) {
            return base_url() . $url;
        }else{
            return base_url() . $target=$url;
        }
    }   
}

if (!function_exists('form_valid'))
{
    function form_valid($validation_errors, $class=null)
    {
        if ($validation_errors == true) {
            if (!empty($class)) {
                return $class;
            }else{
                return 'has-error';
            }
        }
    }   
}

if (!function_exists('combine_valid_message'))
{
    function combine_valid_message($types=array())
    {
        foreach ($types as $value) {
        	if (form_error($value)) {
	        	return strip_tags(form_error($value));
	        }
        }
    }   
}

if (!function_exists('random_keywords'))
{
    function random_keywords($num)
    {
        $char="abcdefghijklmnoprstuwvyzqxABCDEFGHIJKLMNOPRSTUVWYZQX1234567890"; //Char list

        $s=null;
        for ($k=1;$k<=$num;$k++) { 
            $h=substr($char,mt_rand(0,strlen($char)-1),1); 
            $s.=$h; 
        }

        return $s;
    }   
}

if (!function_exists('check_tc'))
{
    function check_tc($tc)
    {
        if(strlen($tc) < 11)
        {
            return false;
        }
        
        if($tc[0] == '0')
        {
            return false;
        }  

        //Calc
        $plus = ($tc[0] + $tc[2] + $tc[4] + $tc[6] + $tc[8]) * 7;  
        $minus = $plus - ($tc[1] + $tc[3] + $tc[5] + $tc[7]);  
        $mod = $minus % 10;  

        if($mod != $tc[9])
        {
            return false;
        }  

        $all = '';  
        for($i = 0 ; $i < 10 ; $i++)
        {
            $all += $tc[$i];
        }  

        if($all % 10 != $tc[10])
        {
            return false;
        }  

        return true; 
    }    
}

if (!function_exists('strBoyut'))
{
    function strBoyut($bayt) {
        if($bayt < 1024) {
            return "$bytes byte"; //Byte cinsini alıyoruz
        }else{
            $kb = $bayt / 1024;
            if ($kb < 1024){
                return sprintf("%01.2f", $kb)." KB"; //KB cinsine dönüştürüyoruz
            }else{
                $mb = $kb / 1024;
                if($mb < 1024){
                    return sprintf("%01.2f", $mb)." MB"; //MB cinsine dönüştürüyoruz
                }else{
                    $gb = $mb / 1024;
                    return sprintf("%01.2f", $gb)." GB"; //GB cinsine dönüştürüyoruz
                }
            }
        }
    }
}

if (!function_exists('replace_tr'))
{
    function replace_tr($text) {
        $text = trim($text);
        $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
        $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
        $new_text = str_replace($search,$replace,$text);

        return $new_text;
    } 
}

if (!function_exists('form_valid'))
{
    function form_valid($validation_errors, $class=null)
    {
        if ($validation_errors == true) {
            if (!empty($class)) {
                return $class;
            }else{
                return 'has-error';
            }
        }
    }   
}

if (!function_exists('change_label'))
{
    function change_label($data)
    {
        $returned = null;
        if ($data) {
            switch (mb_strtolower(replace_tr($data), 'utf-8')) {
                case 'buyukler':
                    $returned = '<span class="label '.mb_strtolower(replace_tr($data), 'utf-8').'">'.mb_strtoupper($data, 'utf-8').'</span>';
                    break;

                case 'kucukler':
                    $returned = '<span class="label '.mb_strtolower(replace_tr($data), 'utf-8').'">'.mb_strtoupper($data, 'utf-8').'</span>';
                    break;

                case 'master':
                    $returned = '<span class="label '.mb_strtolower(replace_tr($data), 'utf-8').'">'.mb_strtoupper($data, 'utf-8').'</span>';
                    break;

                case 'ozel':
                    $returned = '<span class="label '.mb_strtolower(replace_tr($data), 'utf-8').'">'.mb_strtoupper($data, 'utf-8').'</span>';
                    break;

                default:
                    $returned = '<span class="label others">'.mb_strtoupper($data, 'utf-8').'</span>';
            }
        }

        return $returned;
    }   
}

if (!function_exists('change_months'))
{
    function change_months($month)
    {
        $returned = '';
        switch ($month) {
            case '1':
                $returned = 'Ocak';
                break;
            
            case '2':
                $returned = 'Şubat';
                break;

            case '3':
                $returned = 'Mart';
                break;

            case '4':
                $returned = 'Nisan';
                break;

            case '5':
                $returned = 'Mayıs';
                break;

            case '6':
                $returned = 'Haziran';
                break;

            case '7':
                $returned = 'Temmuz';
                break;

            case '8':
                $returned = 'Ağustos';
                break;

            case '9':
                $returned = 'Eylül';
                break;

            case '10':
                $returned = 'Ekim';
                break;

            case '11':
                $returned = 'Kasım';
                break;

            case '12':
                $returned = 'Aralık';
                break;
        }

        return $returned;
    }   
}

if (!function_exists('change_day'))
{
    function change_day($day)
    {
        $returned = '';
        switch ($day) {
            case 'Monday':
                $returned = 'Pazartesi';
                break;
            
            case 'Tuesday':
                $returned = 'Salı';
                break;

            case 'Wednesday':
                $returned = 'Çarşamba';
                break;

            case 'Thursday':
                $returned = 'Perşembe';
                break;

            case 'Friday':
                $returned = 'Cuma';
                break;

            case 'Saturday':
                $returned = 'Cumartesi';
                break;

            case 'Sunday':
                $returned = 'Pazar';
                break;
        }

        return $returned;
    }   
}

if ( ! function_exists('send_email') )
{
    function send_email($param=array())
    {
        $config = array(
            'mailtype'  =>  'html',
            'charset'  =>  'utf-8',
            'protocol'  =>  'smtp',
            'smtp_host' =>  'mail.sporcu.info',
            'smtp_user' =>  'bakgoz@sporcu.info',
            'smtp_pass' =>  'bilal030791',
            'smtp_port' =>  587
        );

        //instance mail class
        $ci=& get_instance();
        $ci->load->library('email');

        $ci->email->initialize($config);
        $ci->email->set_newline("\r\n");
        $ci->email->to($param['to']);
				$ci->email->cc('gknsoftware@hotmail.com');
				$ci->email->bcc('web.gokhan@gmail.com');
        $ci->email->from($param['from'][0], $param['from'][1]);
        $ci->email->subject($param['subject']);
        $ci->email->message($param['message']);
        if($ci->email->send())
        {
            return true;
        }
        else
        {
            return $ci->email->print_debugger();  
        }
    }   
}

if ( ! function_exists('MesajPaneliGonder') )
{
    function MesajPaneliGonder($request)
    {
        $request = "data=" . base64_encode(json_encode($request));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.mesajpaneli.com/json_api/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode(base64_decode($result),TRUE);
    }
}