<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	protected $logged_in;
	protected $page_data;

	public function __construct()
	{
		parent::__construct();

		//Loaded model
		$this->load->model('model_user','model_user',true);
		$this->load->model('model_admin','model_admin',true);

		if ($this->session->userdata('logged_in'))
		{
			//If true logged in
			$this->logged_in = true;

			//Session value assign
			$session_data = $this->session->userdata('logged_in');
			$this->page_data['id'] = $session_data['id'];
			$this->page_data['tcno'] = $session_data['tcno'];
			$this->page_data['auth'] = $session_data['auth'];

			//Local timezone
			date_default_timezone_set('Europe/Istanbul');
		}
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->load->view('admin', $this->page_data);
			
			return true;
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	/**
	 * Loading failed process
	 * @return string
	 */
	public function loadingFailedAddStudentData()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->load->view('loadingFailedProcessAdmin');
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	/**
	 * Loading not allowed extension
	 * @return string
	 */
	public function loadingNotAllowedExt($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$data['studentID'] = $studentID;
			$this->load->view('loadingNotAllowedExt', $data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	/**
	 * Loading add student data
	 * @return string
	 */
	public function loadingAddStudentData($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$data['studentID'] = $studentID;
			$this->load->view('loadingAddStudentData', $data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	/**
	 * Loading delete student data
	 * @return string
	 */
	public function loadingDeleteStudentData($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$data['studentID'] = $studentID;
			$this->load->view('loadingDeleteStudentData', $data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	/**
	 * Loading failed process
	 * @return string
	 */
	public function loadingFailedAddStudentData_JS()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->load->view('loadingFailedProcessAdmin_JS');
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	/**
	 * Loading not allowed extension
	 * @return string
	 */
	public function loadingNotAllowedExt_JS($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$data['studentID'] = $studentID;
			$this->load->view('loadingNotAllowedExt_JS', $data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	/**
	 * Loading add student data
	 * @return string
	 */
	public function loadingAddStudentData_JS($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$data['studentID'] = $studentID;
			$this->load->view('loadingAddStudentData_JS', $data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function generalSettings()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->load->view('generalSettings', $this->page_data);
			
			return true;
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function updateOptions()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			foreach($_POST as $key => $value)
			{
				$this->model_admin->update_option($key, $value);
			}

			//Loading...
			return redirect(route('admin/generalSettings'), 'refresh');
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function cloudData($studentID=null)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->load->view('cloudData', $this->page_data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function addCloudData($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			foreach ($_FILES['cloudFiles']['tmp_name'] as $key => $value)
			{
				$target_dir = "third/uploads/files/";
				$target_file = $target_dir . basename($_FILES["cloudFiles"]["name"][$key]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["cloudFiles"]["tmp_name"][$key]);
					if($check !== false)
					{
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					}
					else
					{
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file))
				{
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["cloudFiles"]["size"][$key] > 3000000)
				{
					echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingFailedAddStudentData').'">';
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" )
				{
					echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingNotAllowedExt/'.$studentID).'">';
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0)
				{
				echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				}
				else
				{
					$clearNewName = $this->model_user->get_student_info($studentID, 'tcno')."-".rand(0, 99999)."-".do_hash($_FILES["cloudFiles"]["name"][$key]).'.'.pathinfo($target_file,PATHINFO_EXTENSION);

					if (move_uploaded_file( $_FILES["cloudFiles"]["tmp_name"][$key], $target_dir.$clearNewName ))
					{
						//Add database
						$param['name'] = $clearNewName;
						$param['type'] = pathinfo($target_file,PATHINFO_EXTENSION);
						$param['date'] = date('Y-m-d H:i:s');

						if ( $this->model_admin->add_student_file($studentID, $param) )
						{
							echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingAddStudentData/'.$studentID).'">';
						}
					}
					else
					{
						echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingFailedAddStudentData').'">';
					}
				}
			}
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function addCloudData_JS($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			foreach ($_FILES['cloudFiles']['tmp_name'] as $key => $value)
			{
				$target_dir = "third/uploads/files/";
				$target_file = $target_dir . basename($_FILES["cloudFiles"]["name"][$key]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
					$check = getimagesize($_FILES["cloudFiles"]["tmp_name"][$key]);
					if($check !== false)
					{
						echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					}
					else
					{
						echo "File is not an image.";
						$uploadOk = 0;
					}
				}
				// Check if file already exists
				if (file_exists($target_file))
				{
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["cloudFiles"]["size"][$key] > 3000000)
				{
					echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingFailedAddStudentData_JS').'">';
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" )
				{
					echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingNotAllowedExt_JS/').'">';
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0)
				{
				echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				}
				else
				{
					$clearNewName = $this->model_user->get_student_info($studentID, 'tcno')."-".rand(0, 99999)."-".do_hash($_FILES["cloudFiles"]["name"][$key]).'.'.pathinfo($target_file,PATHINFO_EXTENSION);

					if (move_uploaded_file( $_FILES["cloudFiles"]["tmp_name"][$key], $target_dir.$clearNewName ))
					{
						//Add database
						$param['name'] = $clearNewName;
						$param['type'] = pathinfo($target_file,PATHINFO_EXTENSION);
						$param['date'] = date('Y-m-d H:i:s');

						if ( $this->model_admin->add_student_file($studentID, $param) )
						{
							echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingAddStudentData_JS/'.$studentID).'">';
						}
					}
					else
					{
						echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingFailedAddStudentData_JS').'">';
					}
				}
			}
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}


	public function deleteData($studentID,$file_id)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			//Remove upload folder and database
			if ( unlink('third/uploads/files/'.$this->model_admin->get_file_info($file_id, 'file_name')) )
			{
				//Remove database
				$this->model_admin->delete_student_file($file_id);

				//Redirect back page
				echo '<meta http-equiv="refresh" content="0;URL='.route('admin/loadingDeleteStudentData/'.$studentID).'">';
			}
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function sendMessage()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->load->view('sendMessage', $this->page_data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function send_message_valid()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$merge_mobiles = array();
			$merge_mobiles['msg_title'] = $this->input->post('msg_title');
			$merge_mobiles['msg_content'] = $this->input->post('msg_content');

			//Merge mobiles
			foreach ($this->input->post('send_valid') as $key => $value) {
				$merge_mobiles['selected_student'][] = $value;
			}
			foreach ($this->input->post('send_valid_parent') as $key => $value) {
				$merge_mobiles['selected_parent'][] = $value;
			}

			$this->load->view('sendMessageValid', $merge_mobiles);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function send_message_process()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
	
			/*
			foreach ($this->input->post('send_valid_parent') as $key => $value) {
				$merge_mobiles[] = $value;
			}*/

			$mesajData['user'] = array(
				'name' => '5326856677',
				'pass' => '3791'
			);
			$mesajData['msgBaslik'] = $this->input->post('msg_title');
			$mesajData['tr'] = true;
			$mesajData['msgData'][] = array(
				'tel' => $this->input->post('student_numberlist'),
				'msg' => $this->input->post('msg_content')
			);

			$mesajInfo = MesajPaneliGonder($mesajData);

			if ( $mesajInfo['status'] == 1 )
			{
				//Datas
				$smsdata['credits'] = $mesajInfo['credits'];
				$smsdata['amount'] = $mesajInfo['amount'];
				$smsdata['ref'] = $mesajInfo['ref'];

				//Render page
				$this->load->view('loadingSendSms', $smsdata);
			}
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

	public function cloudDataAll($studentID=null)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->load->view('cloudDataAll', $this->page_data);
		}
		else
		{
			//If not logged in
			$this->logged_in = false;

			//Back to login
			redirect(base_url(), 'refresh');

			return false;
		}
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */