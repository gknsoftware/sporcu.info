<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header');

$param = array();
$param['tcno'] = $this->model_user->get_student_info($get_id, 'tcno');
$param['ns'] = replace_tr($this->model_user->get_student_info($get_id, 'name').'_'.$this->model_user->get_student_info($get_id, 'surname'));

//New format mobile
$getStudentMobile = $this->model_user->get_student_info($get_id, 'mobile');
$getParent_1_Mobile = $this->model_user->get_parent_info($get_id, 1, 'mobile');
$getParent_2_Mobile = $this->model_user->get_parent_info($get_id, 2, 'mobile');

//Student mobile
$studentMobile = substr($getStudentMobile,0,4);
$studentMobile .= ' '.substr($getStudentMobile,4,3);
$studentMobile .= ' '.substr($getStudentMobile,7,2);
$studentMobile .= ' '.substr($getStudentMobile,9,2);

//Parent 1 mobile
$parent_1_mobile = substr($getParent_1_Mobile,0,4);
$parent_1_mobile .= ' '.substr($getParent_1_Mobile,4,3);
$parent_1_mobile .= ' '.substr($getParent_1_Mobile,7,2);
$parent_1_mobile .= ' '.substr($getParent_1_Mobile,9,2);

//Parent 2 mobile
$parent_2_mobile = substr($getParent_2_Mobile,0,4);
$parent_2_mobile .= ' '.substr($getParent_2_Mobile,4,3);
$parent_2_mobile .= ' '.substr($getParent_2_Mobile,7,2);
$parent_2_mobile .= ' '.substr($getParent_2_Mobile,9,2);
?>

	<div class="container">

		<section class="register" id="Register">
			
			<div class="col-md-2">&nbsp;</div>
			<div class="col-md-8">

				<h1 style="line-height:1.4em; text-align:left;padding-bottom:.8em; font-size:2em;">
				<div class="pull-left"><a href="<?php echo route('profile/showStudentList'); ?>" class="backButton"><i class="fa fa-chevron-left"></i></a></div>
				<div class="pull-left"><span style="color: #18bc9c;padding-left:.5em;"><?php echo mb_strtoupper($this->model_user->get_student_info($get_id, 'name').' '.$this->model_user->get_student_info($get_id, 'surname'), 'utf-8'); ?></span> BİLGİLERİ</div></h1>
				
				<table width="100%" cellspacing="0" cellpadding="0" style="margin: 5em 0;">
					<tbody>
						<tr>
							<td align="center">
								<?php if ( $this->model_user->get_student_info($get_id, 'picture') == '0' ) : ?>

									<?php if ($this->model_user->get_student_info($get_id, 'gender') == '0'): ?>

										<img src="<?php echo get_asset('img', 'man.jpg'); ?>" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">
										
									<?php else : ?>

										<img src="<?php echo get_asset('img', 'woman.png'); ?>" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">

									<?php endif ?>
									
								<?php else : ?>
									
									<img src="<?php echo route($this->model_user->get_student_info($get_id, 'picture')); ?>" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">

								<?php endif; ?>
							</td>
						</tr>
						<tr>
							<td height="50">&nbsp;</td>
						</tr>
						<tr>
							<td align="left">
								<div id="tab-container">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
										<li class="active"><a href="#athlete-info" aria-controls="athlete-info" role="tab" data-toggle="tab">Sporcu Bilgileri</a></li>
										<li><a href="#contact-info" aria-controls="contact-info" role="tab" data-toggle="tab">İletişim Bilgileri</a></li>
										<li><a href="#idenity-info" aria-controls="idenity-info" role="tab" data-toggle="tab">Veli Bilgileri</a></li>
										<li><a href="#training-info" aria-controls="training-info" role="tab" data-toggle="tab">Antrenman Bilgisi</a></li>
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
				    
										<div role="tabpanel" class="tab-pane active" id="athlete-info">
											<div class="btn-group" style="right:0;position:absolute;">
												<a href="#" class="btn btn-primary">İşlemler</a>
												<a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo route('export/pdf/'.$get_id.'/'.$param['tcno'].'/'.$param['ns']); ?>" target="_blank" style="text-decoration:none;">Tescil Fişi (Lisans)</a></li>
													<li><a href="<?php echo route('formsporcu/pdf/'.$get_id.'/'.$param['tcno'].'/'.$param['ns'].'/empty'); ?>" target="_blank" style="text-decoration:none;">Sporcu Bilgileri Formu</a></li>
													<li><a href="<?php echo route('formsporcu/pdf/'.$get_id.'/'.$param['tcno'].'/'.$param['ns']); ?>" target="_blank" style="text-decoration:none;">Antrenman Bilgileri Formu</a></li>
													<li><a href="<?php echo route('admin/cloudData/'.$get_id); ?>" style="text-decoration:none;">Sporcu Verisi Ekle</a></li>
													<li><a href="<?php echo route('profile/editInfo#'.$get_id); ?>" style="text-decoration:none;">Sporcu Bilgileri Düzenle</a></li>
													<li><a href="<?php echo route('profile/deleteInfo/'.$get_id); ?>" style="text-decoration:none;" onclick="return confirm('Öğrenci silinsin mi?')">Sporcu Sil</a></li>
													<li><a href="<?php echo route('export/registerForm/'.$get_id.'/'.$param['tcno'].'/'.$param['ns']); ?>" target="_blank" style="ext-decoration:none;">Kayıt Formu Boş</a></li>
												</ul>
											</div>
											<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
												<tbody>
													<?php if ( $this->model_user->get_student_info($get_id, 'lisance') != '' ) : ?>
													<tr>
														<td>Lisans no</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'lisance'); ?></td>
													</tr>
													<?php endif; ?>
													<?php if ( $this->model_user->get_student_info($get_id, 'teacher') != '' ) : ?>
													<tr>
														<td>Eğitmen</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'teacher'); ?></td>
													</tr>
													<?php endif; ?>
													<?php if ( $this->model_user->get_student_info($get_id, 'groupname') != '' ) : ?>
													<tr>
														<td>Grup</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'groupname'); ?></td>
													</tr>
													<?php endif; ?>
													<tr>
														<td colspan="3">&nbsp;</td>
													</tr>
													<tr>
														<td>T.C. Kimlik no</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'tcno'); ?></td>
													</tr>
													<tr>
														<td>Kulüp</td>
														<td>:</td>
														<td><?php echo mb_strtoupper($this->model_user->get_club_name($this->model_user->get_student_info($get_id, 'club'), 'club_name'), 'utf-8'); ?></td>
													</tr>
													<tr>
														<td>Branş</td>
														<td>:</td>
														<td><?php echo mb_strtoupper($this->model_user->get_branch_name($this->model_user->get_student_info($get_id, 'branch'), 'branch_name'), 'utf-8'); ?></td>
													</tr>
													<tr>
														<td>Ad</td>
														<td>:</td>
														<td><?php echo ucfirst($this->model_user->get_student_info($get_id, 'name')); ?></td>
													</tr>
													<tr>
														<td>Soyad</td>
														<td>:</td>
														<td><?php echo mb_strtoupper($this->model_user->get_student_info($get_id, 'surname'), 'utf-8'); ?></td>
													</tr>
													<tr>
														<td>Anne adı</td>
														<td>:</td>
														<td><?php echo ucfirst($this->model_user->get_student_info($get_id, 'mother')); ?></td>
													</tr>
													<tr>
														<td>Baba adı</td>
														<td>:</td>
														<td><?php echo ucfirst($this->model_user->get_student_info($get_id, 'father')); ?></td>
													</tr>
													<tr>
														<td>Doğum Yeri</td>
														<td>:</td>
														<td><?php echo mb_strtoupper($this->model_user->get_single_county($this->model_user->get_student_info($get_id, 'county')), 'utf-8').' / '.mb_strtoupper($this->model_user->get_single_town($this->model_user->get_student_info($get_id, 'town')), 'utf-8'); ?></td>
													</tr>
													<tr>
														<td>Doğum Tarihi</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'birthdate'); ?></td>
													</tr>
													<tr>
														<td>Cinsiyet</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'gender')==0 ? 'Erkek' : 'Kadın'; ?></td>
													</tr>
												</tbody>
											</table>

											<div class="clearfix"></div>
											
											<h3>NÜFUSA KAYITLI OLDUĞU</h3>
											<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
												<tbody>
													<tr>
														<td>İl</td>
														<td>:</td>
														<td><?php echo mb_strtoupper($this->model_user->get_single_county($this->model_user->get_student_info($get_id, 'population_county')), 'utf-8'); ?></td>
													</tr>
													<tr>
														<td>İlçe</td>
														<td>:</td>
														<td><?php echo mb_strtoupper($this->model_user->get_single_town($this->model_user->get_student_info($get_id, 'population_town')), 'utf-8'); ?></td>
													</tr>
													<tr>
														<td>Mahalle/Köy</td>
														<td>:</td>
														<td><?php echo ucfirst($this->model_user->get_student_info($get_id, 'population_village')); ?></td>
													</tr>
												</tbody>
											</table>

											<div class="clearfix"></div>
											
											<h3>NÜFUS CÜZDANI</h3>
											<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
												<tbody>
													<tr>
														<td>Cilt No</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'skin_no'); ?></td>
													</tr>
													<tr>
														<td>Aile Sıra No</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'family_order_no'); ?></td>
													</tr>
													<tr>
														<td>Hane No</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'house_no'); ?></td>
													</tr>
													<tr>
														<td>Veriliş Tarihi</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'date_of_issue'); ?></td>
													</tr>
													<tr>
														<td>Verildiği Yer</td>
														<td>:</td>
														<td><?php echo mb_strtoupper($this->model_user->get_single_town($this->model_user->get_student_info($get_id, 'place_of_issue_town')), 'utf-8'); ?></td>
													</tr>
												</tbody>
											</table>
										<!-- #athlete-info --> </div>

										<div role="tabpanel" class="tab-pane" id="contact-info">
											<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
												<tbody>
													<tr>
														<td>E-posta aresi</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'email'); ?></td>
													</tr>
													<tr>
														<td>Telefon (cep) no</td>
														<td>:</td>
														<td><?php echo $studentMobile; ?></td>
													</tr>
													<tr>
														<td>Kan Grubu</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'blood'); ?></td>
													</tr>
													<tr>
														<td>Meslek</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'job'); ?></td>
													</tr>
													<tr>
														<td>Okul Bilgileri</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'office'); ?></td>
													</tr>
													<tr>
														<td>Adres</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'address'); ?></td>
													</tr>
													<tr>
														<td>Açıklama</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_student_info($get_id, 'description'); ?></td>
													</tr>
												</tbody>
											</table>
										<!-- #contact-info --> </div>

										<div role="tabpanel" class="tab-pane" id="idenity-info">
											<h3 style="margin: 1em 0;">1. Veli Bilgileri</h3>
											<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
												<tbody>
													<tr>
														<td>Yakınlık</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_proximity_name($this->model_user->get_parent_info($get_id, 1, 'proximity'), 'proximity'); ?></td>
													</tr>
													<tr>
														<td>Ad, Soyad</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 1, 'name'); ?></td>
													</tr>
													<tr>
														<td>E-posta adresi</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 1, 'email'); ?></td>
													</tr>
													<tr>
														<td>Telefon (cep) no</td>
														<td>:</td>
														<td><?php echo $parent_1_mobile; ?></td>
													</tr>
													<tr>
														<td>Meslek</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 1, 'job'); ?></td>
													</tr>
													<tr>
														<td>Adres</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 1, 'address'); ?></td>
													</tr>
													<tr>
														<td>Açıklama</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 1, 'description'); ?></td>
													</tr>
												</tbody>
											</table>
											
											<div class="clearfix"></div>

											<h3 style="margin: 4em 0 1em 0;">2. Veli Bilgileri</h3>
											<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
												<tbody>
													<tr>
														<td>Yakınlık</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_proximity_name($this->model_user->get_parent_info($get_id, 2, 'proximity'), 'proximity'); ?></td>
													</tr>
													<tr>
														<td>Ad, Soyad</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 2, 'name'); ?></td>
													</tr>
													<tr>
														<td>E-posta adresi</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 2, 'email'); ?></td>
													</tr>
													<tr>
														<td>Telefon (cep) no</td>
														<td>:</td>
														<td><?php echo $parent_2_mobile; ?></td>
													</tr>
													<tr>
														<td>Meslek</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 2, 'job'); ?></td>
													</tr>
													<tr>
														<td>Adres</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 2, 'address'); ?></td>
													</tr>
													<tr>
														<td>Açıklama</td>
														<td>:</td>
														<td><?php echo $this->model_user->get_parent_info($get_id, 2, 'description'); ?></td>
													</tr>
												</tbody>
											</table>
										<!-- #idenity-info --> </div>

										<div role="tabpanel" class="tab-pane" id="training-info">
											<h3 style="margin: 1em 0;">Yarış Bilgileri</h3>
											<?php echo nl2br($this->model_user->get_student_info($get_id, 'raceInformation')); ?>

											<div class="clearfix" style="margin:1em 0;"></div>
											
											<h3 style="margin: 1em 0;">Antrenman Bilgileri</h3>
											<?php
											$str_StudentTrainings = '<table class="table table-custom">
											<thead>
												<tr>
													<th>#</th>
													<th>Tarih</th>
													<th>Saat</th>
													<th>Antrenman</th>
													<th>&nbsp;</th>
												</tr>
											</thead>';
											$all_trainings = $this->model_user->get_student_training_info($get_id);
											foreach ($all_trainings as $key => $value)
											{
												$str_StudentTrainings .= '<tr>';
												foreach ($this->model_user->get_training_list($value->training_id) as $_key => $_value)
												{
													@$plus++;

													$expDate = explode('-', $_value->date);

													$str_StudentTrainings .= '<th scope="row">'.$plus.'</th>';
													$str_StudentTrainings .= '<td>'.$expDate[2].' '.change_months($expDate[1]).' '.$expDate[0].'</td>';
													$str_StudentTrainings .= '<td>'.$_value->time.'</td>';
													$str_StudentTrainings .= '<td>'.$_value->training_name.'</td>';
													$str_StudentTrainings .= '<td><i class="fa fa-info-circle" style="cursor:help" tabindex="0" data-toggle="popover" data-trigger="focus" data-placement="left" data-content="'.nl2br($_value->training_description).'"></i></td>';
													
												}
												$str_StudentTrainings .= '</tr>';
											}
											echo $str_StudentTrainings;
											?>
										<!-- #training-info --> </div>
									<!-- .tab-content --> </div>
								<!-- .tab-container --> </div>
							</td>
						</tr>
					</tbody>
				</table>

			</div>
			<div class="col-md-2">&nbsp;</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file editInfo.php */
/* Location: ./application/views/editInfo.php */