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
						<a href="<?php echo route('admin'); ?>"><small class="label label-danger">YÖNETİCİ</small></a>
					<?php endif; ?>
					<?php if($this->model_user->get_student_info($id, 'auth') != 1) : ?>
						<small class="label label-default">ÖĞRENCİ</small>
					<?php endif; ?>
					<br /><br /><p><a href="login/logout" class="logout"><i class="fa fa-power-off"></i></a></p>
				</div>
				
				<div class="clearfix"></div>
				
				<div class="row" style="padding-top: 10%">
					<div class="col-md-12">

						<form action="<?php echo route('admin/updateOptions'); ?>" method="post">
							<div class="form-group">
								<label for="lisance" class="control-label">Filtreleme liste</label>
								<select class="form-control input-lg" name="filterStudentStatus">
									<?php if( $this->model_user->get_option('filterStudentStatus') == 'yes' ) : ?>
										
										<option value="yes" selected>Evet</option>
										<option value="no">Hayır</option>

									<?php else : ?>

										<option value="yes">Evet</option>
										<option value="no" selected>Hayır</option>

									<?php endif; ?>
								</select>
								<small><i class="fa fa-info-circle"></i> Filtrelemede durumu "0" olan öğrenciler listelensin mi?</small>
							<!-- .form-group --> </div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary pull-right">Kaydet</button>
							</div>
						</form>

					</div>
				</div>
			</div>
			<div class="col-md-3">&nbsp;</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file Profile.php */
/* Location: ./application/views/Profile.php */