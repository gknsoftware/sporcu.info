<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	protected $logged_in;
	protected $page_data;
	protected $get_student_id;

	public function __construct()
	{
		parent::__construct();

		//Loaded model
		$this->load->model('model_user','model_user',true);

		if ($this->session->userdata('logged_in'))
		{
			//If true logged in
			$this->logged_in = true;

			//Session value assign
			$session_data = $this->session->userdata('logged_in');
			$this->page_data['id'] = $session_data['id'];
			$this->page_data['tcno'] = $session_data['tcno'];
			$this->page_data['auth'] = $session_data['auth'];

			if ($this->page_data['auth'] == 1) {
				$expID = explode('=',$_SERVER['REQUEST_URI']);
				if (count($expID) > 1) {
					$this->session->set_userdata('page_data',array('idct' => $expID[1]));
				}
			}else{
				
				$this->session->set_userdata('page_data',array('idct' => $session_data['id']));
			}
		}
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$this->load->view('profile', $this->page_data);
			
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

	/*################################################################
	#
	#	COUNTY & TOWN SELECTBOX 
	#
	################################################################*/
	public function selectCountyBirth()
	{
		$session_data = $this->session->userdata('page_data');

		$countyID = $this->input->post('countyID');
		$returned = '';
		if($countyID != 0)
		{
			foreach ($this->model_user->town($countyID) as $k => $v) 
			{
				if ($v->id == $this->model_user->get_student_info($session_data['idct'], 'town')) {
					$returned .= '<option value="'.$v->id.'" selected>'.$v->town_name.'</option>';
				}else{
					$returned .= '<option value="'.$v->id.'">'.$v->town_name.'</option>';
				}

			}

			echo $returned;
		}
		else
		{
			foreach ($this->model_user->counties() as $k_2 => $v_2) 
			{
				if ($v_2->id == $this->model_user->get_student_info($session_data['idct'], 'county')) {
					$returned .= '<option value="'.$v_2->id.'" selected>'.$v_2->county_name.'</option>';
				}else{
					$returned .= '<option value="'.$v_2->id.'">'.$v_2->county_name.'</option>';
				}
			}

			echo $returned;
		}
	}

	public function selectCountyPopulation()
	{
		$session_data = $this->session->userdata('page_data');

		$countyID = $this->input->post('countyID');
		$returned = '';
		if($countyID != 0)
		{
			foreach ($this->model_user->town($countyID) as $k => $v) 
			{
				if ($v->id == $this->model_user->get_student_info($session_data['idct'], 'population_town')) {
					$returned .= '<option value="'.$v->id.'" selected>'.$v->town_name.'</option>';
				}else{
					$returned .= '<option value="'.$v->id.'">'.$v->town_name.'</option>';
				}

			}

			echo $returned;
		}
		else
		{
			foreach ($this->model_user->counties() as $k_2 => $v_2) 
			{
				if ($v_2->id == $this->model_user->get_student_info($session_data['idct'], 'population_county')) {
					$returned .= '<option value="'.$v_2->id.'" selected>'.$v_2->county_name.'</option>';
				}else{
					$returned .= '<option value="'.$v_2->id.'">'.$v_2->county_name.'</option>';
				}
			}

			echo $returned;
		}
	}

	public function selectCountyIssue()
	{
		$session_data = $this->session->userdata('page_data');

		$countyID = $this->input->post('countyID');
		$returned = '';
		if($countyID != 0)
		{
			foreach ($this->model_user->town($countyID) as $k => $v) 
			{
				if ($v->id == $this->model_user->get_student_info($session_data['idct'], 'place_of_issue_town')) {
					$returned .= '<option value="'.$v->id.'" selected>'.$v->town_name.'</option>';
				}else{
					$returned .= '<option value="'.$v->id.'">'.$v->town_name.'</option>';
				}

			}

			echo $returned;
		}
		else
		{
			foreach ($this->model_user->counties() as $k_2 => $v_2) 
			{
				if ($v_2->id == $this->model_user->get_student_info($session_data['idct'], 'place_of_issue_county')) {
					$returned .= '<option value="'.$v_2->id.'" selected>'.$v_2->county_name.'</option>';
				}else{
					$returned .= '<option value="'.$v_2->id.'">'.$v_2->county_name.'</option>';
				}
			}

			echo $returned;
		}
	}

	/*################################################################
	#
	#	STUDENT INFO : FOR STUDENT
	#
	################################################################*/
	public function showInfo()
	{	
		if ($this->session->userdata('logged_in'))
		{
			$this->load->view('showInfo', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/*################################################################
	#
	#	FOR ADMIN
	#
	################################################################
	Show student list */
	public function showStudentList()
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			//Load data
			$this->page_data['student_list'] = $this->model_user->get_student_list();

			//Render page
			$this->load->view('showStudentList', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	//Show student info: for admin
	public function showStudentInfo($get_id)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$this->page_data['get_id'] = $get_id;
			$this->load->view('showStudentInfo', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	//Delete student: for admin
	public function deleteInfo($studentID)
	{
		if ($this->session->userdata('logged_in') && $this->page_data['auth'] == 1)
		{
			$delStudent = $this->db->delete('students', array( 'id' => $studentID ));
			$delParent = $this->db->delete('parent', array( 'student_id' => $studentID ));

			redirect(route('profile/loadingDelete'),'refresh');
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	//Edit student info: for admin
	public function editInfo()
	{
		if ($this->session->userdata('logged_in'))
		{
			//To assign a rule
			$this->form_validation->set_rules('tcno', 'kimlikno', 'trim|required');
			//Assign a message
			$this->form_validation->set_message('required', 'Doldurulması zorunlu alan.');

			$student = '';
			if($this->form_validation->run() == false)
			{
				//Field validation failed.  User redirected to login page
				$this->page_data['addpic'] = null;
				$this->page_data['showerr'] = null;

				if(isset($_GET['student']) && $this->page_data['auth'] == 1) {
					$this->page_data['id'] = $_GET['student'];
					$student = $_GET['student'];
				}
				
				$this->load->view('editInfo', $this->page_data);
			}
			else
			{
				//If success validation return this function
				$this->check_user($student);
			}
		}
		else
		{
			redirect(route('profile'),'refresh');
		}
	}

	//editInfo: extend
	public function check_user($student)
	{
		if ( $this->session->userdata('logged_in') )
		{
			//Field validation succeeded.  Validate against database
			$param = array();

			$param['id'] = $this->input->post('id');
			$param['tcno'] = $this->input->post('tcno');
			$param['club'] = $this->input->post('club');
			$param['branch'] = $this->input->post('branch');
			$param['name'] = $this->input->post('name');
			$param['surname'] = $this->input->post('surname');
			$param['mother'] = $this->input->post('mother');
			$param['father'] = $this->input->post('father');
			$param['counties'] = $this->input->post('counties');
			$param['town'] = $this->input->post('town');
			$param['birthdate'] = $this->input->post('birthdate');
			$param['gender'] = $this->input->post('gender');
			$param['population_county'] = $this->input->post('population_county');
			$param['population_town'] = $this->input->post('population_town');
			$param['village'] = $this->input->post('village');
			$param['skin_no'] = $this->input->post('skin_no');
			$param['family_order_no'] = $this->input->post('family_order_no');
			$param['house_no'] = $this->input->post('house_no');
			$param['date_of_issue'] = $this->input->post('date_of_issue');
			$param['place_of_issue_county'] = $this->input->post('place_of_issue_county');
			$param['place_of_issue_town'] = $this->input->post('place_of_issue_town');
			$param['place_of_issue_town'] = $this->input->post('place_of_issue_town');
			$param['pic'] = $this->input->post('pic');
			$param['lisance'] = $this->input->post('lisance');
			$param['groupname'] = $this->input->post('groupname');
			$param['teacher'] = $this->input->post('teacher');

			//Contact Information
			$param['email'] = $this->input->post('email');
			$param['mobile'] = $this->input->post('mobile');
			$param['address'] = $this->input->post('address');
			$param['description'] = $this->input->post('description');
			$param['raceInformation'] = $this->input->post('raceInformation');
			$param['blood'] = $this->input->post('blood');
			$param['job'] = $this->input->post('job');
			$param['office'] = $this->input->post('office');

			//Parent Information 1
			$param['parent_id_1'] = $this->input->post('parent_id_1');;
			$param['parent_st_1'] = 1;
			$param['parent_type_1'] = $this->input->post('parent_type_1');
			$param['parent_ns_1'] = $this->input->post('parent_ns_1');
			$param['parent_email_1'] = $this->input->post('parent_email_1');
			$param['parent_mobile_1'] = $this->input->post('parent_mobile_1');
			$param['parent_job_1'] = $this->input->post('parent_job_1');
			$param['parent_address_1'] = $this->input->post('parent_address_1');
			$param['parent_description_1'] = $this->input->post('parent_description_1');

			//Parent Information 2
			$param['parent_id_2'] = $this->input->post('parent_id_2');;
			$param['parent_st_2'] = 2;
			$param['parent_type_2'] = $this->input->post('parent_type_2');
			$param['parent_ns_2'] = $this->input->post('parent_ns_2');
			$param['parent_email_2'] = $this->input->post('parent_email_2');
			$param['parent_mobile_2'] = $this->input->post('parent_mobile_2');
			$param['parent_job_2'] = $this->input->post('parent_job_2');
			$param['parent_address_2'] = $this->input->post('parent_address_2');
			$param['parent_description_2'] = $this->input->post('parent_description_2');		

			//Resim Upload aracından verileri alıyoruz
			$pic_name = replace_tr($_FILES["pic"]["name"]); //Resmin ismini çekiyoruz
			$pic_type = $_FILES["pic"]["type"]; //Resmin türü. Örn; JPEG, PNG, GIF vs.
			$pic_size_org = $_FILES["pic"]["size"]; //Resmin orjinal boyutunu alıyoruz
			$pic_size_str = @strBoyut($_FILES["pic"]["size"]); //Resmin dönüştürülmüş boyutunu alıyoruz
			$pic_source = $_FILES["pic"]["tmp_name"]; //Resmin hangi kaynaktan geldiğini alıyoruz
			$pic_target = "third/uploads/pictures/"; //Resmin yükleneceği yolu bir değişkene atadık
			$added_date = date("d.m.Y"); //Bir tarih formatı oluşturduk

			if ( !empty($pic_source) )
			{
				$expExt = explode('.', $pic_name);
				$pic_name = $param['tcno']."-".rand(0, 99999)."-".do_hash($pic_name).'.'.$expExt[1];

		    //Resmi sunucuya yüklememiz(upload) için gereken php kodumuz ayrıca rasgele ürettiğimiz sayı ile resmimizin yanına ürettiğimiz sayıyı ekleyip aynı resimden olma ihtimalini yok ediyoruz
				$picUpload = move_uploaded_file($pic_source,$pic_target.'/'.$pic_name);

				//Veritabanına kaydedilirken sadece resmin ismi değilde resmin yolu, rasgele sayı ürettiğimiz kodumuz ile resmin ismini birleştirerek veritabanına kaydetmemiz için yeni bir değişken oluşturduk
				$param['picture'] = $pic_target.$pic_name;
			}else{
				if(isset($_GET['student'])) {
					$this->page_data['id'] = $_GET['student'];
				}

				$param['picture'] = $this->model_user->get_student_info($this->page_data['id'], 'picture');
			}

			//update data
			$update = $this->model_user->update($param);

			if($update) {
				if($this->page_data['auth'] != 1)
				{
					//E-mail parameters
					$param = array(
						'from' => array('bakgoz@sporcu.info', 'Sporcu Info'), 
						'to' => 'bakgoz@gmail.com',
						'subject' => $param['name'].' '.$param['surname'].' bilgilerini güncelledi.',
						'message' => '
							<p>Ad: '.$param['name'].'</p>
							<p>Soyad: '.$param['surname'].'</p>
							<p>E-posta: '.$param['email'].'</p>'
						);

					send_email($param); // send confirm code	
				}
				
				redirect(route('profile/loadingUpdate'),'refresh');
			}else{
				return false;
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/*################################################################
	#
	#	LOADING CONTROLLERS
	#
	################################################################*/
	public function loadingUpdate()
	{
		$this->load->view('loadingUpdate');
	}

	public function loadingDelete()
	{
		$this->load->view('loadingDelete');
	}

	public function loadingInsert()
	{
		$this->load->view('loadingInsert');
	}

	public function loadingTrainingDelete()
	{
		$this->load->view('loadingTrainingDelete');
	}

	public function loadingTrainingUpdate()
	{
		$this->load->view('loadingTrainingUpdate');
	}

	public function loadingIncomingStudentDelete()
	{
		$this->load->view('loadingIncomingStudentDelete');
	}

	/*################################################################
	#
	#	FILTER CONTROLLERS
	#
	################################################################*/
	public function filter()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$this->load->view('filter');
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/**
	 * Filter: group
	 * 
	 * @return string
	 */
	public function filter_group()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$data = $this->model_user->filter_group($this->input->post('filterGroup'));

			$returned = '';
			if ($data)
			{
				$returned .= '
				<div style="display: inline-block;margin-bottom:25px;">
					<button type="submit" class="btn btn-primary pull-right" style="margin-left:8px;" disabled>Toplam: '.count($data).'</button>
					<a href="'.route('profile/printhtml/'.$this->input->post('filterGroup').'/group').'" target="_blank" class="pull-right" style="margin-left:10px;"><button type="submit" class="btn btn-primary">HTML</button></a>
					<a href="'.route('profile/printpdf/'.$this->input->post('filterGroup').'/group').'" target="_blank" class="pull-right"><button type="submit" class="btn btn-primary">PDF</button></a>
				</div>
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

					$nStatus = ( $this->model_user->get_option('filterStudentStatus') == 'yes' ) ? 0 : 1;
					if ($v->status == $nStatus)
					{
						$returned .= '<div class="col-md-3 col-sm-6 col-xs-12 text-center hover-box">';
							if ( $v->picture == '0' ) :

								if ($v->gender == '0'):
									$returned .= '<a href="showStudentInfo/'.$v->id.'" target="_blank"><img src="'.get_asset('img', 'man.jpg').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;"></a>';
								else :
									$returned .= '<a href="showStudentInfo/'.$v->id.'" target="_blank"><img src="'.get_asset('img', 'woman.png').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;"></a>';
								endif;
								
							else :
								
								$returned .= '<a href="showStudentInfo/'.$v->id.'" target="_blank"><img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;"></a>';

							endif;

							$returned .= '<p style="padding-top: .8em;">';
								$returned .= '<a href="showStudentInfo/'.$v->id.'" target="_blank">'.$v->name.' '.$v->surname.'</a>';
								$returned .= '<small style="display: block;">';
									$returned .= $v->gender==0 ? 'Erkek' : 'Kadın';
									$returned .=  " / ($age)";
									$returned .= '<br />'.$v->birthdate;
									$returned .=  '<br /><span class="label label-info">'.$this->model_user->get_branch_name($v->branch, 'branch_name').' '.$this->model_user->get_Student_Info($v->id, 'lisance').'</span>';
								$returned .= '</small>
							</p>
						</div>';
					}
				}
			}

			echo $returned;
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/**
	 * Filter: Birth year
	 * 
	 * @return mixed
	 */
	public function filter_birthyear()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$data = $this->model_user->filter_birthyear();

			$returned = '';
			if ($data)
			{
				$returned .= '
				<div style="display: inline-block;margin-bottom:25px;">
					<button type="submit" class="btn btn-primary pull-right" style="margin-left:8px;" disabled>Toplam: '.count($data).'</button>
					<a href="'.route('profile/printhtml_birthdate/'.$this->input->post('filterBirthyear').'/birthdate').'" target="_blank" class="pull-right" style="margin-left:10px;"><button type="submit" class="btn btn-primary">HTML</button></a>
				</div>
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

					if ($this->input->post('filterBirthyear') == $expBirth[2])
					{						
						$returned .= '<div class="col-md-3 col-sm-6 col-xs-12 text-center">';
							if ( $v->picture == '0' ) :

								if ($v->gender == '0'):
									$returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
								else :
									$returned .= '<img src="'.get_asset('img', 'woman.png').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
								endif;
								
							else :
								
								$returned .= '<img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">';

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
			}

			echo $returned;
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/**
	 * Filter: teacher
	 * 
	 * @return mixed
	 */
	public function filter_teacher()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$data = $this->model_user->filter_teacher($this->input->post('filterTeacher'));

			$returned = '';
			if ($data)
			{
				$returned .= '
				<span class="label label-info"><a href="'.route('profile/printpdf/'.$this->input->post('filterGroup').'/teacher').'" target="_blank">PDF</a></span>
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
							
							$returned .= '<img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">';

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

			echo $returned;
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/**
	 * Filter: lisance
	 * 
	 * @return mixed
	 */
	public function filter_lisance()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$data = $this->model_user->filter_lisance();

			$returned = '';
			if ($data)
			{	
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

					if ($this->input->post('filterLisance') == 0)
					{
						if (empty($v->lisance) || $v->lisance == 0)
						{
							$returned .= '<div class="col-md-3 col-sm-6 col-xs-12 text-center">';
								if ( $v->picture == '0' ) :

									if ($v->gender == '0'):
										$returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
									else :
										$returned .= '<img src="'.get_asset('img', 'woman.png').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
									endif;
									
								else :
									
									$returned .= '<img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">';

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
					elseif($this->input->post('filterLisance') == 1)
					{
						if ( ! empty($v->lisance))
						{
							$returned .= '<div class="col-md-3 col-sm-6 col-xs-12 text-center">';
								if ( $v->picture == '0' ) :

									if ($v->gender == '0'):
										$returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
									else :
										$returned .= '<img src="'.get_asset('img', 'woman.png').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
									endif;
									
								else :
									
									$returned .= '<img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">';

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
				}
			}

			echo $returned;
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/**
	 * Filter: sort birth
	 * 
	 * @return mixed
	 */
	public function filter_sortbirth_1()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$age_1 = $this->input->post('filterSorthbirt_1');
			$age_2 = $this->input->post('filterSorthbirt_2');

			$data = $this->model_user->filter_sortbirth();

			$returned = '';
			if ($data)
			{
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

					if (($age >= $age_1) && ($age <= $age_2))
					{
						$returned .= '<div class="col-md-3 col-sm-6 col-xs-12 text-center">';
						if ( $v->picture == '0' ) :

							if ($v->gender == '0'):
								$returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
							else :
								$returned .= '<img src="'.get_asset('img', 'woman.png').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
							endif;
							
						else :
							
							$returned .= '<img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">';

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
			}

			echo $returned;
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function printpdf($data, $filter)
	{
		if ( $this->session->userdata('logged_in') )
		{
			switch ($filter)
			{
				case 'group':
					redirect(route('filterpdf/pdf/'.$filter.'/'.$data),'refresh');
					break;
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function raceInformation()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$this->load->view('raceInformation', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function trainingInformation()
	{
		if ( $this->session->userdata('logged_in') )
		{

			$this->load->view('trainingInformation', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function trainingInformationAdd()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$param = array();
			$param['date'] = date('Y-m-d');

			$insert = $this->model_user->add_training($param);

			if ($insert)
			{
				//Loading...
				redirect(route('profile/loadingInsert'), 'refresh');
			}

			
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function trainingInformationEdit()
	{
		if ( $this->session->userdata('logged_in') )
		{
			//To assign a rule
			$this->form_validation->set_rules('training_date', 'Antrenman Tarihi', 'trim|required');

			//Assign a message
			$this->form_validation->set_message('required', 'Doldurulması zorunlu alan.');

			if($this->form_validation->run() == false)
			{
				//Field validation failed.  User redirected to login page
				$this->load->view('trainingInformationEdit', $this->page_data);
			}
			else
			{
				//If success validation return this function
				$this->check_training();

				//Loading...
				redirect(route('profile/loadingTrainingUpdate'), 'refresh');
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function check_training()
	{
		if ( $this->session->userdata('logged_in') )
		{

			//Field validation succeeded.  Validate against database
			$param = array();

			$param['id'] = $_GET['id'];
			$param['training_date'] = $this->input->post('training_date');
			$param['training_time'] = $this->input->post('training_time');
			$param['training_name'] = $this->input->post('training_name');
			$param['training_description'] = $this->input->post('training_description');

			//query the database
			$result = $this->model_user->edit_training($param);

			if ( ! $result)
			{
				return false;
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function add_incoming_student($student_id, $training_id)
	{
		if ( $this->session->userdata('logged_in') )
		{

			$valid = $this->model_user->add_incoming_student($student_id, $training_id);

			if ( ! $valid) {
				echo 'Error! Not added incoming student.';
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function remove_incoming_student($student_id, $training_id)
	{
		if ( $this->session->userdata('logged_in') )
		{
			$valid = $this->model_user->remove_incoming_student($student_id, $training_id);

			if ( ! $valid) {
				echo 'Error! Not remove to incoming student.';
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function trainingInformationList()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$this->load->view('trainingInformationList', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function delete_single_incoming_student($student_id, $training_id)
	{
		if ( $this->session->userdata('logged_in') )
		{
			$valid = $this->model_user->remove_incoming_student($student_id, $training_id);

			if ( ! $valid) {
				echo 'Error! Not remove to incoming student.';
			}else{
				//Loading...
				redirect(route('profile/loadingIncomingStudentDelete/'.$training_id.''), 'refresh');
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function delete_training($training_id)
	{
		if ( $this->session->userdata('logged_in') )
		{
			$delete = $this->model_user->delete_training($training_id);

			if ($delete) {
				//Loading...
				redirect(route('profile/loadingTrainingDelete'), 'refresh');
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function select_training_date()
	{	
		if ( $this->session->userdata('logged_in') )
		{ ?>
		
			<script type="text/javascript">
			/*	GOGO: prompt student group (for training list)
			--------------------------------------------------*/
			function openEmptyList()
			{
				var name = prompt("Bir grup ismi girin.");
				var current_page = $(this).data('href').split('/')[5];

				window.open("<?php echo route('profile/emptyMonthlyTrainingList/'); ?>"+current_page+"/"+name, "_blank");
			}
			$(".openEmptyList").on("click", openEmptyList);

			function openMonthlyCheckList()
			{
				var name = prompt("Bir grup ismi girin.");
				var current_page = $(this).data('href').split('/')[5];//localhost için = 6
				var check_picture = $(this).data('href').split('/')[6];//localhost için = 7

				if (check_picture == undefined) {
					window.open("<?php echo route('profile/monthlyTrainingList/'); ?>"+current_page+"/"+name, "_blank");
				}else{
					window.open("<?php echo route('profile/monthlyTrainingList/'); ?>"+current_page+"/"+name+"/yespic", "_blank");
				};
			}
			$(".openMonthlyCheckList").on("click", openMonthlyCheckList);

			function openYearlyCheckList()
			{
				var name = prompt("Bir grup ismi girin.");
				var current_page = $(this).data('href').split('/')[5];//localhost için = 6
				var check_picture = $(this).data('href').split('/')[6];//localhost için = 7

				if (check_picture == undefined) {
					window.open("<?php echo route('profile/yearlyTrainingList/'); ?>"+current_page+"/"+name, "_blank");
				}else{
					window.open("<?php echo route('profile/yearlyTrainingList/'); ?>"+current_page+"/"+name+"/yespic", "_blank");
				};
			}
			$(".openYearlyCheckList").on("click", openYearlyCheckList);
			</script>

		<?php
			$expYear = explode('-', $this->input->post('month'));
			echo '
			<div class="col-md-12 btn-group">
				<a href="#" class="btn btn-primary">Listeler</a>
				<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="javascript:void(0);" data-href="'.route('profile/emptyMonthlyTrainingList/'.$this->input->post('month').'').'" class="btn btn-primary openEmptyList">Boş Liste</a></li>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" data-href="'.route('profile/monthlyTrainingList/'.$this->input->post('month').'').'" class="btn btn-primary openMonthlyCheckList">Aylık Liste</a></li>
					<li><a href="javascript:void(0);" data-href="'.route('profile/monthlyTrainingList/'.$this->input->post('month').'/yespic').'" class="btn btn-primary openMonthlyCheckList">Aylık Resimli Liste</a></li>
					<li class="divider"></li>
					<li><a href="javascript:void(0);" data-href="'.route('profile/yearlyTrainingList/'.$expYear[0].'').'" class="btn btn-primary openYearlyCheckList">Yıllık Liste</a></li>
					<li><a href="javascript:void(0);" data-href="'.route('profile/yearlyTrainingList/'.$expYear[0].'/yespic').'" class="btn btn-primary openYearlyCheckList">Yıllık Resimli Liste</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
			
			<h1>'.strtoupper(change_months($expYear[1])).' '.$expYear[0].'</h1>
			<table class="table table-custom" style="margin-top: 25px;">
			<thead>
				<tr>
					<th>#</th>
					<th>Tarih</th>
					<th>Saat</th>
					<th>Antrenman Adı</th>
					<th>Sporcular</th>
					<th>İşlemler</th>
				</tr>
			</thead>
			<tbody>';
			foreach ($this->model_user->get_training_list() as $k => $v)
			{
				$expDate = explode('-', $v->date);
				$yearAndMonth = $expDate[0].'-'.$expDate[1];

				if ($yearAndMonth == $this->input->post('month'))
				{
					$yep++; 
				?>
					<tr <?php echo count($this->model_user->training_senc_students_list($v->id))==0 ? 'style="background-color:#ccc;"' : ''; ?>>
						<td><strong><?php echo $yep; ?></strong></td>
						<td><a href="<?php echo route('profile/trainingInformationEdit?id='.$v->id.''); ?>"><?php echo $expDate[2].' '.change_months($expDate[1]).' '.$expDate[0].' '.change_day(date('l', strtotime($v->date))); ?></a></td>
						<td><?php echo $v->time; ?></td>
						<td><?php echo $v->training_name; ?></td>
						<td>
						<a href="javscript:void(0);" 
							data-toggle="popover" 
							data-trigger="focus" 
							data-placement="left" 
							data-content="<?php 
							foreach ($this->model_user->training_senc_students_list($v->id) as $k_2 => $v_2)
							{
								echo $this->model_user->get_student_info($v_2->student_id, 'name').' '.$this->model_user->get_student_info($v_2->student_id, 'surname') . '<br />';
							}
							?>">
							<?php echo count($this->model_user->training_senc_students_list($v->id)); ?></a>
						</td>
						<td>
							<a href="javascript:void(0);" class="btn btn-info btn-xs" tabindex="0" data-toggle="popover" data-trigger="focus" data-placement="left" data-content="<?php echo nl2br($this->model_user->get_training_info($v->id, 'training_description')); ?>">
								<i class="fa fa-info-circle"></i> Açıklama
							</a>
							<a href="<?php echo route('profile/trainingInformationEdit?id='.$v->id.''); ?>" class="btn btn-warning btn-xs">Düzenle</a>
							<a href="<?php echo route('profile/delete_training/'.$v->id); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Antrenman silinsin mi?');">Sil</a>
						</td>
					</tr>
				<?php
				}
			}
			echo '
			</tbody>
			</table>';
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function monthlyTrainingList($month, $group=null, $pic=null)
	{
		if ( $this->session->userdata('logged_in') )
		{
			//Load data
			$this->page_data['trainingMonth'] = $month;
			$this->page_data['trainingGroup'] = $group;
			$this->page_data['trainingStudentPic'] = $pic;

			//Render template
			$this->load->view('monthlyTrainingList', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function yearlyTrainingList($year, $group=null, $pic=null)
	{
		if ( $this->session->userdata('logged_in') )
		{
			//Load data
			$this->page_data['trainingYear'] = $year;
			$this->page_data['trainingGroup'] = $group;
			$this->page_data['trainingStudentPic'] = $pic;

			//Render template
			$this->load->view('yearlyTrainingList', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function emptyMonthlyTrainingList($month, $group=null)
	{
		if ( $this->session->userdata('logged_in') )
		{
			//Load data
			$this->page_data['trainingMonth'] = $month;
			$this->page_data['trainingGroup'] = $group;

			//Render template
			$this->load->view('emptyMonthlyTrainingList', $this->page_data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function updateStatus($studentID, $status)
	{
		if ( $this->session->userdata('logged_in') )
		{
			$update = $this->model_user->update_status($studentID, $status);

			if ($update)
			{
				redirect(route('profile/showStudentList'),'refresh');
			}
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function printhtml($_typenull=null,$type=null)
	{
		if ( $this->session->userdata('logged_in') )
		{
			$this->load->view('filter_printhtml');
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	public function printhtml_birthdate()
	{
		if ( $this->session->userdata('logged_in') )
		{
			$this->load->view('filter_printhtml_birthdate');
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

	/*################################################################
	#
	#	FILTER CONTROLLERS - NEW - 
	#
	################################################################*/
	public function filters($status)
	{
		if ( $this->session->userdata('logged_in') )
		{
			$data['status'] = $status;
			$this->load->view('filters', $data);
		}
		else
		{
			redirect(route('login'),'refresh');
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */