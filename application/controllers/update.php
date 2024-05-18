<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {

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
				$this->load->view('profile');
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
		$param = array();

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

		//Contact Information
		$param['email'] = $this->input->post('email');
		$param['mobile'] = $this->input->post('mobile');
		$param['address'] = $this->input->post('address');
		$param['description'] = $this->input->post('description');
		$param['blood'] = $this->input->post('blood');
		$param['job'] = $this->input->post('job');
		$param['office'] = $this->input->post('office');

		//Parent Information 1
		$param['parent_st_1'] = 1;
		$param['parent_type_1'] = $this->input->post('parent_type_1');
		$param['parent_ns_1'] = $this->input->post('parent_ns_1');
		$param['parent_email_1'] = $this->input->post('parent_email_1');
		$param['parent_mobile_1'] = $this->input->post('parent_mobile_1');
		$param['parent_job_1'] = $this->input->post('parent_job_1');
		$param['parent_address_1'] = $this->input->post('parent_address_1');
		$param['parent_description_1'] = $this->input->post('parent_description_1');

		//Parent Information 2
		$param['parent_st_2'] = 2;
		$param['parent_type_2'] = $this->input->post('parent_type_2');
		$param['parent_ns_2'] = $this->input->post('parent_ns_2');
		$param['parent_email_2'] = $this->input->post('parent_email_2');
		$param['parent_mobile_2'] = $this->input->post('parent_mobile_2');
		$param['parent_job_2'] = $this->input->post('parent_job_2');
		$param['parent_address_2'] = $this->input->post('parent_address_2');
		$param['parent_description_2'] = $this->input->post('parent_description_2');

		//Resim Upload aracından verileri alıyoruz
		$pic_name = $_FILES["pic"]["name"]; //Resmin ismini çekiyoruz
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
			$param['picture'] = 0;
		}

		//update data
		$this->model_user->update($param);
	}

	public function selectCounty()
	{
		$countyID = $this->input->post('countyID');
		$returned = '';
		if($countyID != 0)
		{
			foreach ($this->model_user->town($countyID) as $k => $v) 
			{
				$returned .= '<option value="'.$v->id.'">'.$v->town_name.'</option>';
			}

			echo $returned;
		}
		else
		{
			foreach ($this->model_user->counties() as $k_2 => $v_2) 
			{
				$returned .= '<option value="'.$v_2->id.'">'.$v_2->county_name.'</option>';
			}

			echo $returned;
		}
	}

	public function loading()
	{
		$this->load->view('loading');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */