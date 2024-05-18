<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<div class="container">

		<section class="register" id="Register">
			<div class="col-md-12">

				<h1 style="line-height:1.4em; text-align:center; padding-bottom:2em;">
				<div class="pull-left"><a href="<?php echo route('profile'); ?>" class="backButton"><i class="fa fa-chevron-left"></i></a></div>
				<div class="pull-left" style="padding-left:1em;">ANTRENMAN LİSTELERİ</div></h1>
				
				<div class="col-md-4">
					<div class="form-group">
						<label for="exampleInputEmail1">Tarih giriniz</label>
						<input type="month" class="form-control" id="selectTrainingDate">
					</div>
				</div>

				<div class="col-md-8 text-right">
					<a href="trainingInformationAdd" class="btn btn-default"><i class="fa fa-plus-circle"></i> Antrenman Oluştur</a>
				</div>
				
				<div class="row">
					<div class="col-md-12 trainingInformationList">
						<h1><?php echo date('d').' '.strtoupper(change_months(date('m'))).' '.date('Y'); ?></h1>
						<table class="table table-custom">
						<thead>
							<tr>
								<th>#</th>
								<th>Tarih</th>
								<th>Saat</th>
								<th>Antrenman Adı</th>
								<th>Spr.</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($this->model_user->get_training_list() as $k => $v)
							{
								$expDate = explode('-', $v->date);
								if ( ($expDate[1] == date('m')) && ($expDate[0] == date('Y')) )
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
												<i class="fa fa-info-circle fa-2x"></i> 
											</a>
											<a href="<?php echo route('profile/trainingInformationEdit?id='.$v->id.''); ?>" class="btn btn-warning btn-xs">
												<i class="fa fa-pencil fa-2x"></i>
											</a>
											<a href="<?php echo route('profile/delete_training/'.$v->id); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Antrenman silinsin mi?');">
												<i class="fa fa-times fa-2x"></i>
											</a>
										</td>
									</tr>
							<?php
								}
							} ?>
						</tbody>
						</table>
					</div>
				</div>

			</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file trainingInformation.php */
/* Location: ./application/views/trainingInformation.php */