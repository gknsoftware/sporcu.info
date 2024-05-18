<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 
class Export_Data extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}
 
/* End of file Export.php */
/* Location: ./application/libraries/Export.php */