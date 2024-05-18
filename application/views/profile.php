<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<div class="container">

		<section class="profile" id="Profile">
			
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-6">				
				<div class="text-center" style="display: inline-block; width: 100%;">
					<h1>HOŞGELDİN <span class="text-success"><?php echo mb_strtoupper($this->model_user->get_student_info($id, 'name'), 'UTF-8').' '.mb_strtoupper($this->model_user->get_student_info($id, 'surname'), 'UTF-8'); ?></span></h1>
					<?php if($this->model_user->get_student_info($id, 'auth') == 1) : ?>
						<a href="admin"><small class="label label-danger">YÖNETİCİ</small></a>
					<?php endif; ?>
					<?php if($this->model_user->get_student_info($id, 'auth') != 1) : ?>
						<small class="label label-default">ÖĞRENCİ</small>
					<?php endif; ?>
					<br /><br /><p><a href="login/logout" class="logout"><i class="fa fa-power-off"></i></a></p>
				</div>
				
				<div class="clearfix"></div>
				
				<?php if($this->model_user->get_student_info($id, 'auth') != 1) : ?>
				<div class="col-md-6 box">
					<a href="profile/showInfo"><i class="fa fa-eye"></i> <small>Bilgilerinizi Görüntüleyin</small></a>
				</div>

				<div class="col-md-6 box">
					<a href="profile/editInfo"><i class="fa fa-pencil"></i> <small>Bilgilerinizi Düzenleyin</small></a>
				</div>
				<?php endif; ?>

				<?php if($this->model_user->get_student_info($id, 'auth') == 1) : ?>

					<div class="col-md-6 box">
						<a href="profile/showStudentList"><i class="fa fa-users"></i> <small>Öğrenci Listesi <p style="font-size:12px;">Düzenle & Sil</p></small></a>
					</div>

					<div class="col-md-6 box">
						<a href="profile/filter"><i class="fa fa-filter"></i> <small>Filtreleme <p style="font-size:12px;">Yaş, grup, eğitmen vs.</p></small></a>
					</div>

					<div class="col-md-6 box">
						<a href="profile/trainingInformationList"><i class="fa fa-support"></i> <small>Antrenman Bilgileri <p style="font-size:12px;">-</p></small></a>
					</div>

					<div class="col-md-6 box">
						<a href="profile/raceInformation"><i class="fa fa-bicycle"></i> <small>Aidat Bilgileri <p style="font-size:12px;">-</p></small></a>
					</div>

				<?php endif; ?>
			</div>
			<div class="col-md-3">&nbsp;</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file Profile.php */
/* Location: ./application/views/Profile.php */