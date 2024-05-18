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

	public function add_student_file($studentID,$param)
	{
		//File row & post data
		$fileDataRow = array(
			'student_id' => $studentID,
			'file_name' => $param['name'],
			'file_type' => $param['type'],
			'add_date' => $param['date']
			);

		//Insert to 'options' table
		return $this->db->insert('student_files', $fileDataRow);
	}

	public function get_student_file_list($studentID)
	{
		$this->db->from('student_files');
		$this->db->where('student_id', $studentID);
		$this->db->order_by('file_id', 'desc');
		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function delete_student_file($file_id)
	{
		$returned = $this->db->where( array('file_id' => $file_id) );
		$returned = $this->db->delete('student_files');

		return $returned;
	}

	public function get_file_info($fileID, $i)
	{
		$query = $this->db->query('SELECT * FROM student_files WHERE file_id="'.$fileID.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

}

/* End of file Model_User.php */
/* Location: ./application/models/Model_User.php */