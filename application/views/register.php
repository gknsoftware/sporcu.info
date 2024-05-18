<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layot: Header
$this->load->view('layout/header'); ?>

	<div class="container">

		<section class="register" id="Register">
			
			<div class="col-md-3">&nbsp;</div>

			<div class="col-md-6">

				<h1 class="text-center">KAYIT EKRANI</h1>

				<div class="alert alert-dismissible alert-warning hideResult <?php echo form_valid(validation_errors(), 'show'); ?>">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<p><strong>1-)</strong> Lütfen (vesikalık) resminizi lüklemeyi unutmayın.</p>
					<p><strong>2-)</strong> Sporcu bilgileri, iletişim alanları doldurulması zorunludur.</p>
					<p><strong>3-)</strong> 1. Veli alanları doldurulması zorunlıdır.</p>
				</div>

				<div id="valid-single" class="bg bg-danger <?php echo $showerr == 'show' ? 'show' : 'hidden'; ?>"><?php echo $addpic; ?></div>
				
				<form id="form-register" method="post" action="<?php echo route('register'); ?>" data-valid-type="single" enctype="multipart/form-data" novalidate>
					<div id="tab-container">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#athlete-info" aria-controls="athlete-info" role="tab" data-toggle="tab">Sporcu Bilgileri</a></li>
							<li><a href="#contact-info" aria-controls="contact-info" role="tab" data-toggle="tab">Sporcu İletişim</a></li>
							<li><a href="#idenity-info-1" aria-controls="idenity-info-1" role="tab" data-toggle="tab">1. Veli</a></li>
							<li><a href="#idenity-info-2" aria-controls="idenity-info-2" role="tab" data-toggle="tab">2. Veli</a></li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
	    
							<div role="tabpanel" class="tab-pane active" id="athlete-info">
								<div class="pull-right">
									<div class="showpic pull-left" style="position:relative;right:60px;"></div>
									<div class="form-group fileUpload">
										<div class="fileUpload btn btn-primary">
											<span>Resim yükle</span>
											<input type="file" name="pic" class="upload showpic" />
										</div>
									<!-- .form-group --> </div>
								<!-- .pull-right --> </div>

								<div class="clearfix"></div>

								<div class="form-group">
									<label for="club" class="control-label">Kulüp</label>
									<select class="form-control input-lg" name="club">
										<?php
										foreach ($this->model_user->get_club() as $k => $v) {
											echo '<option value="'.$v->id.'">'.$v->club_name.'</option>';
										}
										?>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="branch" class="control-label">Branş</label>
									<select class="form-control input-lg" name="branch">
										<?php
										foreach ($this->model_user->get_branch() as $k => $v) {
											echo '<option value="'.$v->id.'">'.$v->branch_name.'</option>';
										}
										?>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="tcno" class="control-label">T.C. Kimlik No</label>
									<input type="text" class="form-control input-lg" id="tcno" name="tcno" value="<?php echo $this->input->post('tcno'); ?>" placeholder="XXXXXXXXXXX" pattern="([0-9]|[0-9]|[0-9])" minlength="11" maxlength="11" readonly>
									<small id="wrongTC"></small>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen adınızı girin.">
									<label for="name" class="control-label">Ad</label>
									<input type="text" class="form-control input-lg" id="name" name="name" placeholder="İsim" value="<?php echo $this->input->post('name'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen soyadınızı girin.">
									<label for="surname" class="control-label">Soyad</label>
									<input type="text" class="form-control input-lg" id="surname" name="surname" placeholder="Soyisim" value="<?php echo $this->input->post('surname'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen Ana adını giriniz.">
									<label for="mother" class="control-label">Ana adı</label>
									<input type="text" class="form-control input-lg" id="mother" name="mother" placeholder="İsim" value="<?php echo $this->input->post('mother'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen Baba adını girin.">
									<label for="father" class="control-label">Baba adı</label>
									<input type="text" class="form-control input-lg" id="father" name="father" placeholder="İsim" value="<?php echo $this->input->post('father'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="counties" class="control-label">Doğum yeri / İl</label>
									<select class="form-control input-lg" id="counties" name="counties">
										<option value="0">İl Seçiniz</option>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="town" class="control-label">İlçe</label>
									<select class="form-control input-lg" id="town" name="town">
										<option value="0">Önce İl Seçiniz</option>
									</select>
								<!-- .form-group --> </div>
								<div class="inner-addon right-addon form-group" data-validate="required" data-validtext="Lütfen doğum tarihinizi boş bırakmayın.">
									<label for="birthdate" class="datepicker control-label" data-date-format="dd/mm/yyyy">Doğum tarihi</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control input-lg" id="birthdate" name="birthdate" placeholder="GG/AA/YYYY" value="<?php echo $this->input->post('birthdate'); ?>">
									</div>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="gender" class="control-label">Cinsiyet</label>
									<select class="form-control input-lg" name="gender">
											<option value="0">Erkek</option>
											<option value="1">Kadın</option>
										</select>
								<!-- .form-group --> </div>
								
								<!-- ######### NÜFUS CÜZDANI ######### -->
								<h3>1. TÜRK TABİİYETİNDE İSE</h3>
								<div class="form-group inline-elem">
									<label for="population_county" class="control-label">Nüfusa kayıtlı olduğu / İl</label>
									<select class="form-control input-lg" id="population_county" name="population_county">
										<option value="0">İl Seçiniz</option>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="population_town" class="control-label">İlçe</label>
									<select class="form-control input-lg" id="population_town" name="population_town">
										<option value="0">Önce İl Seçiniz</option>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Nüfusa kayıtlı olduğunuz mahalle/köy bilginizi giriniz.">
									<label for="village" class="control-label">Mahalle / Köy</label>
									<input type="text" class="form-control input-lg" id="village" name="village" placeholder="Merkez köyü" value="<?php echo $this->input->post('village'); ?>">
								<!-- .form-group --> </div>
								
								<!-- ######### NÜFUS CÜZDANI ######### -->
								<h3>NÜFUS CÜZDANI</h3>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Cilt numaranızı giriniz.">
									<label for="skin_no" class="control-label">Cilt no</label>
									<input type="text" class="form-control input-lg" id="skin_no" name="skin_no" placeholder="XXXX" pattern="([0-9]|[0-9]|[0-9])" maxlength="4" value="<?php echo $this->input->post('skin_no'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Aile sıra numaranızı giriniz.">
									<label for="family_order_no" class="control-label">Aile sıra no</label>
									<input type="text" class="form-control input-lg" id="family_order_no" name="family_order_no" placeholder="XXXXX" maxlength="5" value="<?php echo $this->input->post('family_order_no'); ?>">
								<!-- .form-group --> </div>
								<div class="clearfix"></div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Hane numaranızı giriniz">
									<label for="house_no" class="control-label">Hane no</label>
									<input type="text" class="form-control input-lg" id="house_no" name="house_no" placeholder="XXXX" pattern="([0-9]|[0-9]|[0-9])" maxlength="4" value="<?php echo $this->input->post('house_no'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Veriliş tarihini boş bırakmayın.">
									<label for="date_of_issue" class="control-label" data-date-format="dd/mm/yyyy">Veriliş tarihi</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control input-lg" id="date_of_issue" name="date_of_issue" placeholder="GG/AA/YYYY" value="<?php echo $this->input->post('date_of_issue'); ?>">
									</div>
								<!-- .form-group --> </div>
								<div class="clearfix"></div>
								<div class="form-group inline-elem">
									<label for="place_of_issue_county" class="control-label">Verildiği yer / İl</label>
									<select class="form-control input-lg" id="place_of_issue_county" name="place_of_issue_county">
										<option value="0">İl Seçiniz</option>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="place_of_issue_town" class="control-label">İlçe</label>
									<select class="form-control input-lg" id="place_of_issue_town" name="place_of_issue_town">
										<option value="0">Önce İl Seçiniz</option>
									</select>
								<!-- .form-group --> </div>
								<div class="clearfix"></div>
							<!-- #athlete-info --> </div>

							<div role="tabpanel" class="tab-pane" id="contact-info">
								<div class="form-group" data-validate="required" data-validtext="İletişim e-posta'nızı girinizi." data-second-validtext="Lütfen e-posta adresini doğru giriniz.">
									<label for="email" class="control-label">E-posta adresi</label>
									<input type="email" class="form-control input-lg" id="email" name="email" placeholder="mailadresi@mail.com" value="<?php echo $this->input->post('email'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="İletişim cep telefonu giriniz.">
									<label for="mobile" class="control-label">Telefon (cep)</label>
									<input type="text" class="form-control input-lg" id="mobile" name="mobile" placeholder="05XX XXX XX XX" pattern="([0-9]|[0-9]|[0-9])" maxlength="14" value="<?php echo $this->input->post('mobile'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Mesleğinizi giriniz.">
									<label for="blood" class="control-label">Kan grubu</label>
									<input type="text" class="form-control input-lg" id="blood" name="blood" placeholder="0 (RH) +" value="<?php echo $this->input->post('blood'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Mesleğinizi giriniz.">
									<label for="job" class="control-label">Meslek</label>
									<input type="text" class="form-control input-lg" id="job" name="job" placeholder="Öğrenci" value="<?php echo $this->input->post('job'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="İş yeri adresinizi giriniz.">
									<label for="office" class="control-label">İş/Okul bilgileri</label>
									<textarea class="form-control input-lg" id="office" name="office" rows="4"><?php echo $this->input->post('office'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="İletişim adresinizi giriniz.">
									<label for="address" class="control-label">Adres</label>
									<textarea class="form-control input-lg" id="address" name="address" rows="4"><?php echo $this->input->post('address'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="description" class="control-label">Açıklama</label>
									<textarea class="form-control input-lg" id="description" name="description" rows="4"><?php echo $this->input->post('description'); ?></textarea>
								<!-- .form-group --> </div>
							<!-- #contact-info --> </div>

							<div role="tabpanel" class="tab-pane" id="idenity-info-1">
								<div class="form-group">
									<label for="parent_type_1" class="control-label">Yakınlık derecesi</label>
									<select name="parent_type_1" class="form-control input-lg">
										<?php foreach ($this->model_user->get_proximity_list() as $k => $v): ?>
											<option value="<?php echo $v->id; ?>"><?php echo $v->proximity; ?></option>
										<?php endforeach ?>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Veli ad, soyad giriniz.">
									<label for="parent_ns_1" class="control-label">Ad, Soyad</label>
									<input type="text" class="form-control input-lg" id="parent_ns_1" name="parent_ns_1" placeholder="İsim Soyisim" value="<?php echo $this->input->post('parent_ns_1'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Veli e-posta adresini giriniz." data-second-validtext="Lütfen e-posta adresini doğru giriniz.">
									<label for="parent_email_1" class="control-label">E-posta adresi</label>
									<input type="email" class="form-control input-lg" id="parent_email_1" name="parent_email_1" placeholder="veli1@mail.com" value="<?php echo $this->input->post('parent_email_1'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Veli cep telefonunu giriniz.">
									<label for="parent_mobile_1" class="control-label">Telefon (cep)</label>
									<input type="text" class="form-control input-lg" id="parent_mobile_1" name="parent_mobile_1" placeholder="05XX XXX XX XX" pattern="([0-9]|[0-9]|[0-9])" maxlength="14" value="<?php echo $this->input->post('parent_mobile_1'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_job_1" class="control-label">Mesleği</label>
									<input type="text" class="form-control input-lg" id="parent_job_1" name="parent_job_1" placeholder="Avukat" value="<?php echo $this->input->post('parent_job_1'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_address_1" class="control-label">Adres</label>
									<textarea class="form-control input-lg" id="parent_address_1" name="parent_address_1" rows="3"><?php echo $this->input->post('parent_address_1'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_description_1" class="control-label">Açıklama</label>
									<textarea class="form-control input-lg" id="parent_description_1" name="parent_description_1" rows="3"><?php echo $this->input->post('parent_description_1'); ?></textarea>
								<!-- .form-group --> </div>
							<!-- #idenity-info-1 --> </div>

							<div role="tabpanel" class="tab-pane" id="idenity-info-2">
								<div class="form-group">
									<label for="parent_type_2" class="control-label">Yakınlık derecesi</label>
									<select name="parent_type_2" class="form-control input-lg">
										<?php foreach ($this->model_user->get_proximity_list() as $k => $v): ?>
											<option value="<?php echo $v->id; ?>"><?php echo $v->proximity; ?></option>
										<?php endforeach ?>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_ns_2" class="control-label">Ad, Soyad</label>
									<input type="text" class="form-control input-lg" id="parent_ns_2" name="parent_ns_2" placeholder="İsim Soyisim" value="<?php echo $this->input->post('parent_ns_2'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_email_2" class="control-label">E-posta adresi</label>
									<input type="email" class="form-control input-lg" id="parent_email_2" name="parent_email_2" placeholder="veli2@mail.com" value="<?php echo $this->input->post('parent_email_2'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_mobile_2" class="control-label">Telefon (cep)</label>
									<input type="text" class="form-control input-lg" id="parent_mobile_2" name="parent_mobile_2" placeholder="05XX XXX XX XX" pattern="([0-9]|[0-9]|[0-9])" maxlength="14" value="<?php echo $this->input->post('parent_mobile_2'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_job_2" class="control-label">Mesleği</label>
									<input type="text" class="form-control input-lg" id="parent_job_2" name="parent_job_2" placeholder="Avukat" value="<?php echo $this->input->post('parent_job_2'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_address_2" class="control-label">Adres</label>
									<textarea class="form-control input-lg" id="parent_address_2" name="parent_address_2" rows="3"><?php echo $this->input->post('parent_address_2'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_description_2" class="control-label">Açıklama</label>
									<textarea class="form-control input-lg" id="parent_description_2" name="parent_description_2" rows="3"><?php echo $this->input->post('parent_description_2'); ?></textarea>
								<!-- .form-group --> </div>	
							<!-- #idenity-info-2 --> </div>

							<div class="form-group pull-right">
								<button type="reset" class="btn btn-secondary">Temizle</button>
								<button type="submit" class="btn btn-success" data-loading-text="Bekleyin..." id="formvalid" data-form="register">Kayıt ol</button>
							<!-- .form-group --> </div>

						<!-- .tab-content --> </div>
					<!-- #tab-container --> </div>
				<!-- form --> </form>

			</div>

			<div class="col-md-3">&nbsp;</div>

		</section>

<?php
//Layot: Footer
$this->load->view('layout/footer');

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */
?>