<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function match($table, $rows=array())
	{
		$query = $this->db->get_where($table, $rows);

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function login($tcno)
	{
		$validTC = $this->match('students', array('tcno' => $tcno));

		if ($validTC) {
			return true;
		}else{
			return false;
		}
	}

	public function _login($tcno,$password)
	{
		$query = $this->db->get_where('students', array(
			'tcno' => $tcno, 
			'password' => $password
			));

		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function register($param)
	{
		//Member row & post data
		$memberDataRow = array(
			'tcno' => $param['tcno'],
			'club' => $param['club'],
			'branch' => $param['branch'],
			'name' => $param['name'],
			'surname' => $param['surname'],
			'mother' => $param['mother'],
			'father' => $param['father'],
			'county' => $param['counties'],
			'town' => $param['town'],
			'birthdate' => $param['birthdate'],
			'gender' => $param['gender'],
			'population_county' => $param['population_county'],
			'population_town' => $param['population_town'],
			'population_village' => $param['village'],
			'skin_no' => $param['skin_no'],
			'family_order_no' => $param['family_order_no'],
			'house_no' => $param['house_no'],
			'date_of_issue' => $param['date_of_issue'],
			'place_of_issue_county' => $param['place_of_issue_county'],
			'place_of_issue_town' => $param['place_of_issue_town'],
			'picture' => $param['picture'],
			'email' => $param['email'],
			'mobile' => $param['mobile'],
			'blood' => $param['blood'],
			'job' => $param['job'],
			'office' => $param['office'],
			'address' => $param['address'],
			'description' => $param['description'],
			'status' => $param['status']
			);

		$validTC = $this->match('students', array('tcno' => $param['tcno']));

		if ( ! $validTC )
		{
			//Insert to 'members' table
			$this->db->set('regdate', 'NOW()', false);
			$register = $this->db->insert('students', $memberDataRow);

			//Last insert id
			$param['last_insert_id'] = $this->db->insert_id();

			if ($register)
			{
				//Insert parents
				$this->reg_parent_1($param);
				$this->reg_parent_2($param);
			}
		}
		else
		{
			return false;
		}
		

	}

	public function update($param)
	{
		//Member row & post data
		$memberDataRow = array(
			'tcno' => $param['tcno'],
			'club' => $param['club'],
			'branch' => $param['branch'],
			'name' => $param['name'],
			'surname' => $param['surname'],
			'mother' => $param['mother'],
			'father' => $param['father'],
			'county' => $param['counties'],
			'town' => $param['town'],
			'birthdate' => $param['birthdate'],
			'gender' => $param['gender'],
			'population_county' => $param['population_county'],
			'population_town' => $param['population_town'],
			'population_village' => $param['village'],
			'skin_no' => $param['skin_no'],
			'family_order_no' => $param['family_order_no'],
			'house_no' => $param['house_no'],
			'date_of_issue' => $param['date_of_issue'],
			'place_of_issue_county' => $param['place_of_issue_county'],
			'place_of_issue_town' => $param['place_of_issue_town'],
			'picture' => $param['picture'],
			'email' => $param['email'],
			'mobile' => $param['mobile'],
			'blood' => $param['blood'],
			'job' => $param['job'],
			'office' => $param['office'],
			'address' => $param['address'],
			'description' => $param['description'],
			'raceInformation' => $param['raceInformation'],
			'lisance' => $param['lisance'],
			'groupname' => $param['groupname'],
			'teacher' => $param['teacher']
			);


		//Update to 'members' table
		$update = $this->db->where('tcno', trim($param['tcno']));
		$update = $this->db->update('students', $memberDataRow);

		if ($update)
		{
			//Update parents
			$this->upd_parent_1($param);
			$this->upd_parent_2($param);

			return true;
		}else
		{
			return false;
		}
		

	}

	/*************************************************
	 *
	 * REGISTER PARENTS
	 * 
	 *************************************************/
	public function reg_parent_1($param)
	{
		//Parent row & post data
		$parentDataRow = array(
			'student_id' => $param['last_insert_id'],
			'parent_st' => $param['parent_st_1'],
			'proximity' => $param['parent_type_1'],
			'name' => $param['parent_ns_1'],
			'email' => $param['parent_email_1'],
			'mobile' => $param['parent_mobile_1'],
			'job' => $param['parent_job_1'],
			'address' => $param['parent_address_1'],
			'description' => $param['parent_description_1']
			);

		//Insert to 'members' table
		$this->db->insert('parent', $parentDataRow);
	}

	public function reg_parent_2($param)
	{
		//Parent row & post data
		$parentDataRow = array(
			'student_id' => $param['last_insert_id'],
			'parent_st' => $param['parent_st_2'],
			'proximity' => $param['parent_type_2'],
			'name' => $param['parent_ns_2'],
			'email' => $param['parent_email_2'],
			'mobile' => $param['parent_mobile_2'],
			'job' => $param['parent_job_2'],
			'address' => $param['parent_address_2'],
			'description' => $param['parent_description_2']
			);

		//Insert to 'members' table
		$this->db->insert('parent', $parentDataRow);
	}

	/*************************************************
	 *
	 * UPDATE PARENTS
	 * 
	 *************************************************/
	public function upd_parent_1($param)
	{
		//Parent row & post data
		$parentDataRow = array(
			'parent_st' => $param['parent_st_1'],
			'proximity' => $param['parent_type_1'],
			'name' => $param['parent_ns_1'],
			'email' => $param['parent_email_1'],
			'mobile' => $param['parent_mobile_1'],
			'job' => $param['parent_job_1'],
			'address' => $param['parent_address_1'],
			'description' => $param['parent_description_1']
			);

		//Update to 'parent' table
		$update = $this->db->where('id', $param['parent_id_1']);
		$update = $this->db->update('parent', $parentDataRow);
	}

	public function upd_parent_2($param)
	{
		//Parent row & post data
		$parentDataRow = array(
			'parent_st' => $param['parent_st_2'],
			'proximity' => $param['parent_type_2'],
			'name' => $param['parent_ns_2'],
			'email' => $param['parent_email_2'],
			'mobile' => $param['parent_mobile_2'],
			'job' => $param['parent_job_2'],
			'address' => $param['parent_address_2'],
			'description' => $param['parent_description_2']
			);

		//Update to 'parent' table
		$update = $this->db->where('id', $param['parent_id_2']);
		$update = $this->db->update('parent', $parentDataRow);
	}

	public function change_password($studentID, $password)
	{
		//Parent row & post data
		$studentNewPassword = array(
			'password' => $password
			);

		//Update to 'parent' table
		$update = $this->db->where('id', $studentID);
		$update = $this->db->update('students', $studentNewPassword);

		if ($update) {
			return true;
		}else{
			return false;
		}
	}

	public function get_proximity_list()
	{
		$this->db->from('proximity');
		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function get_proximity_name($proximityID, $i)
	{
		$query = $this->db->query('SELECT * FROM proximity WHERE id="'.$proximityID.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function get_student_info($studentID, $i)
	{
		$query = $this->db->query('SELECT * FROM students WHERE id="'.$studentID.'"  ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function get_student_info_tc($tcno, $i)
	{
		$query = $this->db->query('SELECT * FROM students WHERE tcno="'.trim($tcno).'"  ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function get_student_info_mobile($mobile, $i)
	{
		$query = $this->db->query('SELECT * FROM students WHERE mobile="'.trim($mobile).'"  ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function get_parent_info($studentID, $st, $i)
	{
		$query = $this->db->query('SELECT * FROM parent WHERE student_id="'.$studentID.'" && parent_st="'.$st.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function get_parent_info_mobile($mobile, $st, $i)
	{
		$query = $this->db->query('SELECT * FROM parent WHERE mobile="'.$mobile.'" && parent_st="'.$st.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function get_club_name($clubID, $i)
	{
		$query = $this->db->query('SELECT * FROM clubs WHERE id="'.$clubID.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function get_branch_name($branchID, $i)
	{
		$query = $this->db->query('SELECT * FROM branch WHERE id="'.$branchID.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function counties()
	{
		$this->db->from('county');
		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function town($countyID)
	{
		$this->db->from('town');
		$this->db->where('county_id', $countyID);
		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function get_club()
	{
		$this->db->from('clubs');
		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function get_branch()
	{
		$this->db->from('branch');
		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function get_single_county($countyID)
	{
		$query = $this->db->query('SELECT * FROM county WHERE id="'.$countyID.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];

			return $row->county_name;
		}
	}

	public function get_single_town($townID)
	{
		$query = $this->db->query('SELECT * FROM town WHERE id="'.$townID.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];

			return $row->town_name;
		}
	}

	public function get_student_list()
	{
		$this->db->from('students');
		$this->db->order_by('status', 'desc');
		$this->db->order_by('groupname,name', 'asc');
		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function filter_group($group)
	{
		$query = $this->db->query('SELECT * FROM students WHERE groupname="'.$group.'" AND status="1"  ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			return $res;
		}
	}

	public function filter_teacher($teacher)
	{
		$query = $this->db->query('SELECT * FROM students WHERE teacher="'.$teacher.'" ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			return $res;
		}
	}

	public function filter_birthyear()
	{
		$query = $this->db->query('SELECT * FROM students WHERE status="1" ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			return $res;
		}
	}

	public function filter_lisance()
	{
		$query = $this->db->query('SELECT * FROM students ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			return $res;
		}
	}

	public function filter_sortbirth()
	{
		$query = $this->db->query('SELECT * FROM students ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			return $res;
		}
	}

	public function student_filter_list($filter, $data=null)
	{
		$w='';
		switch ($filter) {
			case 'group':
				$w = ' WHERE groupname="'.trim($data).'"';
				break;

			case 'teacher':
				$w = ' WHERE teacher="'.$data.'"';
				break;

			case 'all':
				$w = null;
				break;
		}

		$query = $this->db->query('SELECT * FROM students '.$w. 'ORDER BY name');
		$res = $query->result();

		if ($res)
		{
			return $res;
		}
	}

	public function match_training($table, $rows=array())
	{
		$query = $this->db->get_where($table, $rows);

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}

	public function add_training($param)
	{
		//Parent row & post data
		$trainingDataRow = array(
			'date' => $param['date']
			);

		//Insert to 'trainings' table
		$returned = $this->db->insert('trainings', $trainingDataRow);

		return $returned;
	}

	public function get_training_list($trainingID=null)
	{
		$this->db->from('trainings');
		$this->db->order_by("date", "desc");
		!empty($trainingID) ? $this->db->where('id', $trainingID) : null;

		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function add_incoming_student($student_id, $training_id)
	{
		$returned = $this->db->insert('training_incoming', array(
			'training_id' => $training_id,
			'student_id' => $student_id
			));

		return $returned;
	}

	public function remove_incoming_student($student_id, $training_id)
	{
		$returned = $this->db->where(array('student_id' => $student_id, 'training_id' => $training_id));
		$returned = $this->db->delete('training_incoming');

		return $returned;
	}

	public function edit_training($param)
	{
		//Member row & post data
		$trainingDataRow = array(
			'date' => $param['training_date'],
			'time' => $param['training_time'],
			'training_name' => $param['training_name'],
			'training_description' => $param['training_description']
			);


		//Update to 'members' table
		$update = $this->db->where('id', trim($param['id']));
		$update = $this->db->update('trainings', $trainingDataRow);
	}

	public function get_training_info($trainingID, $i)
	{
		$query = $this->db->query('SELECT * FROM trainings WHERE id="'.$trainingID.'"');
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			$arr = (array) $row;

			return $arr[ $i ];
		}
	}

	public function training_senc_students_list($training_id)
	{
		$this->db->from('training_incoming');
		$this->db->where("training_id", $training_id); 

		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function delete_training($training_id)
	{
		//Remove "training" column
		$returned = $this->db->where(array('id' => $training_id));
		$returned = $this->db->delete('trainings');

		//Remove "training_incoming" column
		$returned = $this->db->where(array('training_id' => $training_id));
		$returned = $this->db->delete('training_incoming');

		return $returned;
	}

	public function get_student_training_info($studentID)
	{
		$this->db->from('training_incoming');
		$this->db->where('student_id', $studentID);
		$this->db->order_by("training_id", "desc"); 

		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function get_incoming_list($trainingID, $studentID=null)
	{
		$this->db->from('training_incoming');
		if ($studentID != null) {
			$this->db->where('student_id', $studentID);
		}else
		{
			$this->db->where('training_id', $trainingID);
		}

		$query = $this->db->get();
		
		if ($query) {
			return $query->result();
		}
	}

	public function update_status($studentID, $status)
	{
		//Student row & post data
		$studentDataRow = array(
			'status' => $status
			);


		//Update to 'members' table
		$update = $this->db->where('id', trim($studentID));
		$update = $this->db->update('students', $studentDataRow);

		if ($update) {
			return true;
		}else {
			return false;
		}
	}

	public function get_option($name)
	{
		//Get member id
		if ($this->session->userdata('logged_in'))
				$session_data = $this->session->userdata('logged_in');

		//Check same value
		$query = $this->db->get_where('options', array('option_key' => $name));
		$res = $query->result();

		if ($res)
		{
			$row = $res[0];
			return $row->option_value;
		}
	}

}

/* End of file Model_User.php */
/* Location: ./application/models/Model_User.php */