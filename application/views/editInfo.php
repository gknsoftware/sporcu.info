<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layot: Header
$this->load->view('layout/header');  ?>

	<div class="container">

		<section class="update" id="Update">
			
			<div class="col-md-3">&nbsp;</div>

			<div class="col-md-6">

				<h1 style="line-height:1.4em; text-align:left;">
				<div class="pull-left"><a href="<?php echo route('profile/showStudentList'); ?>" class="backButton"><i class="fa fa-chevron-left"></i></a></div>
				<div class="pull-left"><span style="color: #18bc9c;padding-left:.5em;"><?php echo mb_strtoupper($this->model_user->get_student_info($id, 'name').' '.$this->model_user->get_student_info($id, 'surname'), 'utf-8'); ?></span> DÜZENLE</div></h1>
					
				<div class="clearfix" style="padding:3em 0;"></div>

				<div class="alert alert-dismissible alert-warning hideResult <?php echo form_valid(validation_errors(), 'show'); ?>">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<p><strong>1-)</strong> Lütfen (vesikalık) resminizi yüklemeyi unutmayın.</p>
					<p><strong>2-)</strong> Sporcu bilgileri, iletişim alanları doldurulması zorunludur.</p>
					<p><strong>3-)</strong> 1. Veli alanları doldurulması zorunludır.</p>
				</div>

				<div id="valid-single" class="bg bg-danger <?php echo $showerr == 'show' ? 'show' : 'hidden'; ?>"><?php echo $addpic; ?></div>
				
				<form id="form-update" method="post" action="<?php echo route('profile/editInfo?student='.$id); ?>" data-valid-type="single" enctype="multipart/form-data" novalidate>
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
									<div class="showpic pull-left" style="position:relative;right:60px;">
										<?php if ( $this->model_user->get_student_info($id, 'picture') == '0' ) : ?>

											<?php if ($this->model_user->get_student_info($id, 'gender') == '0'): ?>
												<img src="<?php echo get_asset('img', 'man.jpg'); ?>" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">
											<?php else : ?>
												<img src="<?php echo get_asset('img', 'woman.png'); ?>" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">
											<?php endif ?>
											
										<?php else : ?>

											<img src="<?php echo route($this->model_user->get_student_info($id, 'picture')); ?>" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">

										<?php endif; ?>
									</div>
									<div class="form-group fileUpload">
										<div class="fileUpload btn btn-primary">
											<span>Resim yükle</span>
											<input type="file" name="pic" class="upload showpic" />
										</div>
									<!-- .form-group --> </div>
								<!-- .pull-right --> </div>

								<div class="clearfix"></div>
								
								<?php if($auth == 1) : //If login admin ?>
									<div class="form-group">
										<label for="lisance" class="control-label">Lisans no</label>
										<input type="text" class="form-control input-lg" id="lisance" name="lisance" placeholder="06-XXXXXXXXXXXX" value="<?php echo $this->model_user->get_student_info($id, 'lisance'); ?>">
									<!-- .form-group --> </div>
									<div class="form-group">
										<label for="groupname" class="control-label">Grup</label>
										<input type="text" class="form-control input-lg" id="groupname" name="groupname" placeholder="Küçükler" value="<?php echo $this->model_user->get_student_info($id, 'groupname'); ?>">
									<!-- .form-group --> </div>
									<div class="form-group">
										<label for="teacher" class="control-label">Eğitmen</label>
										<input type="text" class="form-control input-lg" id="teacher" name="teacher" placeholder="İsim SOYİSİM" value="<?php echo $this->model_user->get_student_info($id, 'teacher'); ?>">
									<!-- .form-group --> </div>
								<?php else : ?>
									<div class="form-group hidden">
										<label for="lisance" class="control-label">Lisans no</label>
										<input type="hidden" class="form-control input-lg" id="lisance" name="lisance" placeholder="06-XXXXXXXXXXXX" value="<?php echo $this->model_user->get_student_info($id, 'lisance'); ?>">
									<!-- .form-group --> </div>
									<div class="form-group hidden">
										<label for="groupname" class="control-label">Grup</label>
										<input type="hidden" class="form-control input-lg" id="groupname" name="groupname" placeholder="Küçükler" value="<?php echo $this->model_user->get_student_info($id, 'groupname'); ?>">
									<!-- .form-group --> </div>
									<div class="form-group hidden">
										<label for="teacher" class="control-label">Eğitmen</label>
										<input type="hidden" class="form-control input-lg" id="teacher" name="teacher" placeholder="İsim SOYİSİM" value="<?php echo $this->model_user->get_student_info($id, 'teacher'); ?>">
									<!-- .form-group --> </div>
								<?php endif; ?>
								<div class="form-group">
									<label for="club" class="control-label">Kulüp</label>
									<select class="form-control input-lg" name="club">
										<?php
										foreach ($this->model_user->get_club() as $k => $v) {
											if ($v->id == $this->model_user->get_student_info($id, 'club')) {
												echo '<option value="'.$v->id.'" selected>'.$v->club_name.'</option>';
											}else{
												echo '<option value="'.$v->id.'">'.$v->club_name.'</option>';
											}
										}
										?>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="branch" class="control-label">Branş</label>
									<select class="form-control input-lg" name="branch">
										<?php
										foreach ($this->model_user->get_branch() as $k => $v) {
											if ($v->id == $this->model_user->get_student_info($id, 'branch')) {
												echo '<option value="'.$v->id.'" selected>'.$v->branch_name.'</option>';
											}else{
												echo '<option value="'.$v->id.'">'.$v->branch_name.'</option>';
											}
										}
										?>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="id" class="control-label">T.C. Kimlik No</label>
									<input type="hidden" class="form-control input-lg" id="id" name="id" value="<?php echo $id; ?>" readonly>
									<input type="text" class="form-control input-lg" id="tcno" name="tcno" value="<?php echo $this->model_user->get_student_info($id, 'tcno'); ?>" placeholder="XXXXXXXXXXX" pattern="([0-9]|[0-9]|[0-9])" minlength="11" maxlength="11" readonly>
									<small id="wrongTC"></small>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen adınızı girin.">
									<label for="name" class="control-label">Ad</label>
									<input type="text" class="form-control input-lg" id="name" name="name" placeholder="İsim" value="<?php echo $this->model_user->get_student_info($id, 'name'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen soyadınızı girin.">
									<label for="surname" class="control-label">Soyad</label>
									<input type="text" class="form-control input-lg" id="surname" name="surname" placeholder="Soyisim" value="<?php echo $this->model_user->get_student_info($id, 'surname'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen Ana adını giriniz.">
									<label for="mother" class="control-label">Ana adı</label>
									<input type="text" class="form-control input-lg" id="mother" name="mother" placeholder="İsim" value="<?php echo $this->model_user->get_student_info($id, 'mother'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Lütfen Baba adını girin.">
									<label for="father" class="control-label">Baba adı</label>
									<input type="text" class="form-control input-lg" id="father" name="father" placeholder="İsim" value="<?php echo $this->model_user->get_student_info($id, 'father'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="counties" class="control-label">Doğum yeri / İl</label>
									<select class="form-control input-lg" id="counties" name="counties">
										<!-- country -->
									</select>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="town" class="control-label">İlçe</label>
									<select class="form-control input-lg" id="town" name="town">
										<?php
										$optionCountyBirth = '';
										foreach ($this->model_user->town($this->model_user->get_student_info($id, 'county')) as $k => $v) 
										{
											if ($v->id == $this->model_user->get_student_info($id, 'town')) {
												$optionCountyBirth .= '<option value="'.$v->id.'" selected>'.$v->town_name.'</option>';
											}else{
												$optionCountyBirth .= '<option value="'.$v->id.'">'.$v->town_name.'</option>';
											}

										}

										echo $optionCountyBirth;
										?>
									</select>
								<!-- .form-group --> </div>
								<div class="inner-addon right-addon form-group" data-validate="required" data-validtext="Lütfen doğum tarihinizi boş bırakmayın.">
									<label for="birthdate" class="datepicker control-label" data-date-format="dd/mm/yyyy">Doğum tarihi</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control input-lg" id="birthdate" name="birthdate" placeholder="GG/AA/YYYY" value="<?php echo $this->model_user->get_student_info($id, 'birthdate'); ?>">
									</div>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="gender" class="control-label">Cinsiyet</label>
									<select class="form-control input-lg" name="gender">
										<?php if ($this->model_user->get_student_info($id, 'gender') == 0) : ?>
											<option value="0" selected>Erkek</option>
											<option value="1">Kadın</option>
										<?php else : ?>
											<option value="0">Erkek</option>
											<option value="1" selected>Kadın</option>
										<?php endif; ?>
									</select>
								<!-- .form-group --> </div>
								
								<!-- ######### NÜFUS CÜZDANI ######### -->
								<h3>1. TÜRK TABİİYETİNDE İSE</h3>
								<div class="form-group inline-elem">
									<label for="population_county" class="control-label">Nüfusa kayıtlı olduğu / İl</label>
									<select class="form-control input-lg" id="population_county" name="population_county">
										<!-- population county -->
									</select>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="population_town" class="control-label">İlçe</label>
									<select class="form-control input-lg" id="population_town" name="population_town">
										<?php
										$optionCountyPopulation = '';
										foreach ($this->model_user->town($this->model_user->get_student_info($id, 'population_county')) as $k => $v) 
										{
											if ($v->id == $this->model_user->get_student_info($id, 'population_town')) {
												$optionCountyPopulation .= '<option value="'.$v->id.'" selected>'.$v->town_name.'</option>';
											}else{
												$optionCountyPopulation .= '<option value="'.$v->id.'">'.$v->town_name.'</option>';
											}

										}

										echo $optionCountyPopulation;
										?>
									</select>
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Nüfusa kayıtlı olduğunuz mahalle/köy bilginizi giriniz.">
									<label for="village" class="control-label">Mahalle / Köy</label>
									<input type="text" class="form-control input-lg" id="village" name="village" placeholder="Merkez köyü" value="<?php echo $this->model_user->get_student_info($id, 'population_village'); ?>">
								<!-- .form-group --> </div>
								
								<!-- ######### NÜFUS CÜZDANI ######### -->
								<h3>NÜFUS CÜZDANI</h3>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Cilt numaranızı giriniz.">
									<label for="skin_no" class="control-label">Cilt no</label>
									<input type="text" class="form-control input-lg" id="skin_no" name="skin_no" placeholder="XXXX" pattern="([0-9]|[0-9]|[0-9])" maxlength="4" value="<?php echo $this->model_user->get_student_info($id, 'skin_no'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Aile sıra numaranızı giriniz.">
									<label for="family_order_no" class="control-label">Aile sıra no</label>
									<input type="text" class="form-control input-lg" id="family_order_no" name="family_order_no" placeholder="XXXXX" maxlength="5" value="<?php echo $this->model_user->get_student_info($id, 'family_order_no'); ?>">
								<!-- .form-group --> </div>
								<div class="clearfix"></div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Hane numaranızı giriniz">
									<label for="house_no" class="control-label">Hane no</label>
									<input type="text" class="form-control input-lg" id="house_no" name="house_no" placeholder="XXXX" pattern="([0-9]|[0-9]|[0-9])" maxlength="4" value="<?php echo $this->model_user->get_student_info($id, 'house_no'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group inline-elem" data-validate="required" data-validtext="Kimlik: Veriliş tarihini boş bırakmayın.">
									<label for="date_of_issue" class="control-label" data-date-format="dd/mm/yyyy">Veriliş tarihi</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										<input type="text" class="form-control input-lg" id="date_of_issue" name="date_of_issue" placeholder="GG/AA/YYYY" value="<?php echo $this->model_user->get_student_info($id, 'date_of_issue'); ?>">
									</div>
								<!-- .form-group --> </div>
								<div class="clearfix"></div>
								<div class="form-group inline-elem">
									<label for="place_of_issue_county" class="control-label">Verildiği yer / İl</label>
									<select class="form-control input-lg" id="place_of_issue_county" name="place_of_issue_county">
										<!-- place of issue county -->
									</select>
								<!-- .form-group --> </div>
								<div class="form-group inline-elem">
									<label for="place_of_issue_town" class="control-label">İlçe</label>
									<select class="form-control input-lg" id="place_of_issue_town" name="place_of_issue_town">
										<?php
										$optionCountyIssue = '';
										foreach ($this->model_user->town($this->model_user->get_student_info($id, 'place_of_issue_county')) as $k => $v) 
										{
											if ($v->id == $this->model_user->get_student_info($id, 'place_of_issue_town')) {
												$optionCountyIssue .= '<option value="'.$v->id.'" selected>'.$v->town_name.'</option>';
											}else{
												$optionCountyIssue .= '<option value="'.$v->id.'">'.$v->town_name.'</option>';
											}

										}

										echo $optionCountyIssue;
										?>
									</select>
								<!-- .form-group --> </div>
								<div class="clearfix"></div>
							<!-- #athlete-info --> </div>

							<div role="tabpanel" class="tab-pane" id="contact-info">
								<div class="form-group" data-validate="required" data-validtext="İletişim e-posta'nızı girinizi." data-second-validtext="Lütfen e-posta adresini doğru giriniz.">
									<label for="email" class="control-label">E-posta adresi</label>
									<input type="email" class="form-control input-lg" id="email" name="email" placeholder="mailadresi@mail.com" value="<?php echo $this->model_user->get_student_info($id, 'email'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="İletişim cep telefonu giriniz.">
									<label for="mobile" class="control-label">Telefon (cep)</label>
									<input type="text" class="form-control input-lg" id="mobile" name="mobile" placeholder="05XX XXX XX XX" pattern="([0-9]|[0-9]|[0-9])" maxlength="14" value="<?php echo $this->model_user->get_student_info($id, 'mobile'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Mesleğinizi giriniz.">
									<label for="blood" class="control-label">Kan grubu</label>
									<input type="text" class="form-control input-lg" id="blood" name="blood" placeholder="0 (RH) +" value="<?php echo $this->model_user->get_student_info($id, 'blood'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Mesleğinizi giriniz.">
									<label for="job" class="control-label">Meslek</label>
									<input type="text" class="form-control input-lg" id="job" name="job" placeholder="Öğrenci" value="<?php echo $this->model_user->get_student_info($id, 'job'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="İş yeri adresinizi giriniz.">
									<label for="office" class="control-label">Okul bilgileri</label>
									<textarea class="form-control input-lg" id="office" name="office" rows="4"><?php echo $this->model_user->get_student_info($id, 'office'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="İletişim adresinizi giriniz.">
									<label for="address" class="control-label">Adres</label>
									<textarea class="form-control input-lg" id="address" name="address" rows="4"><?php echo $this->model_user->get_student_info($id, 'address'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="description" class="control-label">Açıklama</label>
									<textarea class="form-control input-lg" id="description" name="description" rows="4"><?php echo $this->model_user->get_student_info($id, 'description'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="raceInformation" class="control-label">Yarış Bilgileri</label>
									<textarea class="form-control input-lg" id="raceInformation" name="raceInformation" rows="4"><?php echo $this->model_user->get_student_info($id, 'raceInformation'); ?></textarea>
								<!-- .form-group --> </div>
							<!-- #contact-info --> </div>

							<div role="tabpanel" class="tab-pane" id="idenity-info-1">
								<div class="form-group">
									<label for="parent_type_1" class="control-label">Yakınlık derecesi</label>
									<select name="parent_type_1" class="form-control input-lg">
										<?php foreach ($this->model_user->get_proximity_list() as $k => $v): ?>

											<?php if ($this->model_user->get_parent_info($id, 1, 'proximity') == $v->id): ?>
												<option value="<?php echo $v->id ?>" selected><?php echo $v->proximity ?></option>
											<?php else: ?>
												<option value="<?php echo $v->id ?>"><?php echo $v->proximity ?></option>
											<?php endif ?>

										<?php endforeach ?>
									</select>
									<input type="hidden" class="form-control input-lg" id="parent_id_1" name="parent_id_1" value="<?php echo $this->model_user->get_parent_info($id, 1, 'id'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Veli ad, soyad giriniz.">
									<label for="parent_ns_1" class="control-label">Ad, Soyad</label>
									<input type="text" class="form-control input-lg" id="parent_ns_1" name="parent_ns_1" placeholder="İsim Soyisim" value="<?php echo $this->model_user->get_parent_info($id, 1, 'name'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Veli e-posta adresini giriniz." data-second-validtext="Lütfen e-posta adresini doğru giriniz.">
									<label for="parent_email_1" class="control-label">E-posta adresi</label>
									<input type="email" class="form-control input-lg" id="parent_email_1" name="parent_email_1" placeholder="veli1@mail.com" value="<?php echo $this->model_user->get_parent_info($id, 1, 'email'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group" data-validate="required" data-validtext="Veli cep telefonunu giriniz.">
									<label for="parent_mobile_1" class="control-label">Telefon (cep)</label>
									<input type="text" class="form-control input-lg" id="parent_mobile_1" name="parent_mobile_1" placeholder="05XX XXX XX XX" pattern="([0-9]|[0-9]|[0-9])" maxlength="14" value="<?php echo $this->model_user->get_parent_info($id, 1, 'mobile'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_job_1" class="control-label">Mesleği</label>
									<input type="text" class="form-control input-lg" id="parent_job_1" name="parent_job_1" placeholder="Avukat" value="<?php echo $this->model_user->get_parent_info($id, 1, 'job'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_address_1" class="control-label">Adres</label>
									<textarea class="form-control input-lg" id="parent_address_1" name="parent_address_1" rows="3"><?php echo $this->model_user->get_parent_info($id, 1, 'address'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_description_1" class="control-label">Açıklama</label>
									<textarea class="form-control input-lg" id="parent_description_1" name="parent_description_1" rows="3"><?php echo $this->model_user->get_parent_info($id, 1, 'description'); ?></textarea>
								<!-- .form-group --> </div>
							<!-- #idenity-info-1 --> </div>

							<div role="tabpanel" class="tab-pane" id="idenity-info-2">
								<div class="form-group">
									<label for="parent_type_2" class="control-label">Yakınlık derecesi</label>
									<select name="parent_type_2" class="form-control input-lg">
										<?php foreach ($this->model_user->get_proximity_list() as $k => $v): ?>

											<?php if ($this->model_user->get_parent_info($id, 2, 'proximity') == $v->id): ?>
												<option value="<?php echo $v->id ?>" selected><?php echo $v->proximity ?></option>
											<?php else: ?>
												<option value="<?php echo $v->id ?>"><?php echo $v->proximity ?></option>
											<?php endif ?>

										<?php endforeach ?>
									</select>
									<input type="hidden" class="form-control input-lg" id="parent_id_2" name="parent_id_2" value="<?php echo $this->model_user->get_parent_info($id, 2, 'id'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_ns_2" class="control-label">Ad, Soyad</label>
									<input type="text" class="form-control input-lg" id="parent_ns_2" name="parent_ns_2" placeholder="İsim Soyisim" value="<?php echo $this->model_user->get_parent_info($id, 2, 'name'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_email_2" class="control-label">E-posta adresi</label>
									<input type="email" class="form-control input-lg" id="parent_email_2" name="parent_email_2" placeholder="veli1@mail.com" value="<?php echo $this->model_user->get_parent_info($id, 2, 'email'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_mobile_2" class="control-label">Telefon (cep)</label>
									<input type="text" class="form-control input-lg" id="parent_mobile_2" name="parent_mobile_2" placeholder="05XX XXX XX XX" pattern="([0-9]|[0-9]|[0-9])" maxlength="14" value="<?php echo $this->model_user->get_parent_info($id, 2, 'mobile'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_job_2" class="control-label">Mesleği</label>
									<input type="text" class="form-control input-lg" id="parent_job_2" name="parent_job_2" placeholder="Avukat" value="<?php echo $this->model_user->get_parent_info($id, 2, 'job'); ?>">
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_address_2" class="control-label">Adres</label>
									<textarea class="form-control input-lg" id="parent_address_2" name="parent_address_2" rows="3"><?php echo $this->model_user->get_parent_info($id, 2, 'address'); ?></textarea>
								<!-- .form-group --> </div>
								<div class="form-group">
									<label for="parent_description_2" class="control-label">Açıklama</label>
									<textarea class="form-control input-lg" id="parent_description_2" name="parent_description_2" rows="3"><?php echo $this->model_user->get_parent_info($id, 2, 'description'); ?></textarea>
								<!-- .form-group --> </div>
							<!-- #idenity-info-2 --> </div>

							<div class="form-group pull-right">
								<button type="submit" class="btn btn-success" data-loading-text="Bekleyin..." id="formvalid" data-form="update">Düzenle</button>
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

/* End of file Editinfo.php */
/* Location: ./application/controllers/Editinfo.php */
?>