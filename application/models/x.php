<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_admin extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function add_option($name,$value)
	{
		//Check same value
		$query = $this->db->get_where('options', array('option_key' => $name));

		if ($query->num_rows() > 0)
		{
			return false;
		}
		else
		{
			//Option row & post data
			$optionDataRow = array(
				'option_key' => $name,
				'option_value' => $value
				);

			//Insert to 'options' table
			return $this->db->insert('options', $optionDataRow);
		}
	}

	public function update_option($name,$value)
	{
		//Check same value
		$query = $this->db->get_where('options', array('option_key' => $name));

		if ($query->num_rows() > 0)
		{
			//Option row & post data
			$optionDataRow = array(
				'option_value' => $value
				);

			//Update to 'options' table
			$query = $this->db->where('option_key', $name);
			$query = $this->db->update('options', $optionDataRow);

			return $query;
		}
		else
		{
			return $this->add_option($name,$value);
		}
	}

}

/* End of file Model_User.php */
/* Location: ./application/models/Model_User.php */