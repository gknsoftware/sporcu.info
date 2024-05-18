<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	protected $logged_in;
	protected $page_data;

	public function __construct()
	{
		parent::__construct();

		//Loaded model
		$this->load->model('model_user','model_user',true);

		if ($this->session->userdata('logged_in'))
		{
			return $this->logged_in = true;
		}
		else
		{
			return $this->logged_in = false;
		}
	}

	public function index()
	{
		if ( ! $this->logged_in )
		{
			//To assign a rule
			$this->form_validation->set_rules('tcno', 'kimlikno', 'trim|required');

			//Assign a message
			$this->form_validation->set_message('required', 'Doldurulması zorunlu alan.');

			if($this->form_validation->run() == false)
			{
				//Field validation failed.  User redirected to login page
				$this->load->view('login');
			}
			else
			{
				//If success validation return this function
				$this->check_user();
			}
		}
		else
		{
			redirect(route('profile'),'refresh');
		}
	}

	public function check_user()
	{
		//Field validation succeeded.  Validate against database
		$tcno = $this->input->post('tcno');

		//query the database
		$result = $this->model_user->login($tcno);

		if ($result)
		{
			$this->load->view('enterPassword');
		}
		else
		{
			//Page data
			$this->page_data['addpic'] = null;
			$this->page_data['showerr'] = null;

			//Render page
			$this->load->view('register', $this->page_data);
		}
	}

	public function enterPassword()
	{
		//Field validation succeeded. Validate against database
		$tcno = $this->input->post('tcno');
		$password = do_hash($this->input->post('password'));

		//query the database
		$result = $this->model_user->_login($tcno, $password);

		if ($result)
		{
			$sess_array = array();
			foreach ($result as $row)
			{
				$sess_array = array(
					'id' => $row->id,
					'tcno' => $row->tcno,
					'auth' => $row->auth
					);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			redirect(route('profile'),'refresh');

			return true;
		}
		else
		{
			redirect(route('login'),'refresh');

			return false;
		}
	}

	public function createNewPassword()
	{
		if ( ! $this->logged_in )
		{
			//To assign a rule
			$this->form_validation->set_rules('password', 'şifre', 'trim|required|min_length[8]|matches[passconf]');
			$this->form_validation->set_rules('passconf', 'şifre doğrulama', 'trim|required');

			//Assign a message
			$this->form_validation->set_message('required', 'Lütfen gerkeli alanları doldurun.');
			$this->form_validation->set_message('matches', 'Şifreler birbiriyle eşleşmiyor!');
			$this->form_validation->set_message('min_length', 'Şifreniz en düşük 8 karakterden oluşmalıdır!');

			if($this->form_validation->run() == false)
			{
				$this->load->view('createNewPassword');
			}
			else
			{
				//Password update row & post data
				$query = $this->db->where('tcno', trim($this->input->post('tcno')));
				$query = $this->db->update('students', array(
					'password' => do_hash($this->input->post('password'))
				));

				redirect(route('register/loading'),'refresh');
			}
		}
		else
		{
			redirect(route('profile'),'refresh');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		//session_destroy();
		redirect(route('login'), 'refresh');
	}

	public function checkTC()
	{
		$tcno = $this->input->post('tcno');

		if (check_tc( $tcno ))
		{
			echo '<div id="bool" style="display:none;">1</div>';
			echo '<span style="color: #71B095; padding: .4em; display: block;"><i class="fa fa-check"></i> T.C. Kimlik numarası doğrulandı.</span>';

			return true;
		}
		else
		{
			echo '<div id="bool" style="display:none;">0</div>';
			echo '<span style="color: #D13F32; padding: .4em; display: block;"><i class="fa fa-times"></i> T.C. Kimlik numarası doğrulanmadı!</span>';

			return false;
		}
	}

	public function checkRegisteredUser()
	{
		$tcno = $this->input->post('tcno');
		$match = $this->model_user->match('students', array('tcno' => $tcno));

		if ($match)
		{	
			echo '<div id="bool_2" style="display:none;">1</div>';
			echo '<span style="color: #71B095; padding: .4em; display: block;"><i class="fa fa-check"></i> Sisteme kayıtlısınız.</span>';
		}
		else
		{
			echo '<div id="bool_2" style="display:none;">0</div>';
			echo '<span style="color: #D13F32; padding: .4em; display: block;"><i class="fa fa-times"></i> Sisteme kayıtlı değilsiniz!</span>';
		}
	}

	/**
	 * Loading change password email
	 * @return string
	 */
	public function loadingChangePasswordEmail()
	{
		$this->load->view('loadingChangePasswordEmail');
	}

	/**
	 * Loading change password
	 * @return string
	 */
	public function loadingChangePassword()
	{
		$this->load->view('loadingChangePassword');
	}

	/**
	 * Loading change password
	 * @return string
	 */
	public function loadingFailedProcess()
	{
		$this->load->view('loadingFailedProcess');
	}

	public function forgotPassword($tcno)
	{

		$this->load->view('forgotPassword');
	}

	public function sendNewPassword($tcno)
	{
		$decodeTCNO = $this->encrypt->decode( $tcno );
		$registerEmail = $this->model_user->match('students', array( 'email' => $this->input->post('email') ));
		$validEmail = $this->model_user->match('students', array( 'id' => $this->model_user->get_student_info_tc($decodeTCNO, 'id'), 'email' => $this->input->post('email') ));

		if ( ! $registerEmail) 
		{
			echo '<meta http-equiv="refresh" content="0;URL='.route('login/forgotPassword/'.$tcno.'/?is=noregister').'">';
		}
		elseif ( ! $validEmail) 
		{
			echo '<meta http-equiv="refresh" content="0;URL='.route('login/forgotPassword/'.$tcno.'/?is=nomatch').'">';
		}
		else
		{
			//E-mail parameters
			$param = array(
				'from' => array('bakgoz@sporcu.info', 'Sporcu Info'), 
				'to' => $this->model_user->get_student_info_tc($decodeTCNO, 'email'),
				'subject' => 'sporcu.info şifre sıfırlama bağlantısı.',
				'message' => '
				<p><strong>Sayın;</strong> '.$this->model_user->get_student_info_tc($decodeTCNO, 'name').' '.$this->model_user->get_student_info_tc($decodeTCNO, 'surname').' şifre sıfırlama bağlantınız.</p>
				<p><a href="'.route('login/enterNewPassword/'.$tcno).'">Bu bağlantıdan şifrenizi sıfırlayın.</a></p>'
				);

			send_email($param); // send confirm code

			return redirect(route('login/loadingChangePasswordEmail'),'refresh');
		}
	}

	public function enterNewPassword($tcno)
	{
		//Render page
		$this->load->view('enterNewPassword');
	}

	public function refreshMyPassword($tcno)
	{
		//Input post data
		$password_1 = $this->input->post('pass');
		$password_2 = $this->input->post('pass_rety');

		if ( ($password_1 == '') && ($password_2 == '') )
		{
			echo '<meta http-equiv="refresh" content="0;URL='.route('login/enterNewPassword/'.$tcno.'?is=empty').'">';
		}
		elseif( $password_1 != $password_2 )
		{
			echo '<meta http-equiv="refresh" content="0;URL='.route('login/enterNewPassword/'.$tcno.'?is=nomatch').'">';
		}
		else
		{
			$c = $this->model_user->change_password( $this->model_user->get_student_info_tc($this->encrypt->decode($tcno), 'id'), do_hash($password_1) );

			if ($c == true)
			{
				redirect(route('login/loadingChangePassword'),'refresh');
			}
			else
			{
				redirect(route('login/loadingFailedProcess'),'refresh');
			}
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */