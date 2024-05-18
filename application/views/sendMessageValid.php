<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<div class="container-fluid">

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
				
				<form action="<?php echo route('admin/send_message_process'); ?>" method="post">
				<input type="hidden" name="msg_title" value="<?php echo $msg_title; ?>"></input>
				<input type="hidden" name="msg_content" value="<?php echo $msg_content; ?>"></input>
				<div class="row" style="padding-top: 10%">
					<div class="row col-md-12">
						<h3>GÖNDERİLECEK METİN</h3>
						<strong><?php echo $msg_title; ?> ismiyle;</strong>
						<p><?php echo $msg_content; ?></p>

						<h3>SEÇİLMİŞ KİŞİLER</h3>

						<div class="row">
							<div class="col-md-12">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active"><a href="#allstudents" aria-controls="allstudents" role="tab" data-toggle="tab">Sporcular</a></li>
									<li role="presentation"><a href="#parents" aria-controls="parents" role="tab" data-toggle="tab">Veliler</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="allstudents">
										<table class="table table-list-search" id="contentlist">
											<thead>
												<tr>
													<th>İsim</th>
													<th>Grup</th>
													<th>Telefon</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($selected_student as $key => $value) : ?>
													<tr>
														<input type="hidden" name="student_numberlist[]" value="<?php echo $value; ?>"></input>
														<td><?php echo $this->model_user->get_student_info_mobile($value, 'name') . ' ' . $this->model_user->get_student_info_mobile($value, 'surname'); ?></td>
														<td><?php echo $this->model_user->get_student_info_mobile($value, 'groupname'); ?></td>
														<td><?php echo $this->model_user->get_student_info_mobile($value, 'mobile'); ?></td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
									<div role="tabpanel" class="tab-pane" id="parents">
										<table class="table table-list-search" id="contentlist_parent">
											<thead>
												<tr>
													<th>Öğrenci</th>
													<th>Yakınlık</th>
													<th>Veli</th>
													<th>Telefon</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($selected_parent as $key => $value) :
													//Parent 1
													$parent_sid_st_1 = $this->model_user->get_parent_info_mobile($value, 1, 'student_id');
													$parent_name_st_1 = $this->model_user->get_parent_info_mobile($value, 1, 'name');
													$parent_proximity_st_1 = $this->model_user->get_parent_info_mobile($value, 1, 'proximity');
													$parent_mobile_st_1 = $this->model_user->get_parent_info_mobile($value, 1, 'mobile');
													
													//Parent 2
													$parent_sid_st_2 = $this->model_user->get_parent_info_mobile($value, 2, 'student_id');
													$parent_name_st_2 = $this->model_user->get_parent_info_mobile($value, 2, 'name');
													$parent_proximity_st_2 = $this->model_user->get_parent_info_mobile($value, 2, 'proximity');
													$parent_mobile_st_2 = $this->model_user->get_parent_info_mobile($value, 2, 'mobile');

													if( $parent_mobile_st_1 != '' ) : ?>
														<tr>
															<td><?php echo ($this->model_user->get_student_info($parent_sid_st_1, 'status')==1) ? $this->model_user->get_student_info($parent_sid_st_1, 'name').' '.$this->model_user->get_student_info($parent_sid_st_1, 'surname') : '<strike style="color:red">'.$this->model_user->get_student_info($parent_sid_st_1, 'name').' '.$this->model_user->get_student_info($parent_sid_st_1, 'surname').'</strike>'; ?></td>
															<td>
																<p><?php echo $this->model_user->get_proximity_name( $parent_proximity_st_1, 'proximity' ); ?></p>
															</td>
															<td>
																<p><?php echo $parent_name_st_1; ?></p>
															</td>
															<td>
																<p><?php echo $parent_mobile_st_1; ?></p>
															</td>
														</tr>
													<?php
													endif;

													if( $parent_mobile_st_2 != '' ) : ?>
														<tr>
															<td><?php echo ($this->model_user->get_student_info($parent_sid_st_2, 'status')==1) ? $this->model_user->get_student_info($parent_sid_st_2, 'name').' '.$this->model_user->get_student_info($parent_sid_st_2, 'surname') : '<strike style="color:red">'.$this->model_user->get_student_info($parent_sid_st_2, 'name').' '.$this->model_user->get_student_info($parent_sid_st_2, 'surname').'</strike>'; ?></td>
															<td>
																<p><?php echo $this->model_user->get_proximity_name( $parent_proximity_st_2, 'proximity' ); ?></p>
															</td>
															<td>
																<p><?php echo $parent_name_st_2; ?></p>
															</td>
															<td>
																<p><?php echo $parent_mobile_st_2; ?></p>
															</td>
														</tr>
													<?php endif; ?>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>

								<p class="pull-right">
									<button type="submit" class="btn btn-primary" onclick="history.go(-1)">Geri dön</button>
									<button type="submit" class="btn btn-success" onclick="return confirm('Seçili kişilere gönderilsin mi?')">Onaylıyorum</button>
								</p>
							</div>
						<!-- .row --> </div>
					</div>
				</div>
				</form>
			</div>
			<div class="col-md-3">&nbsp;</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file Profile.php */
/* Location: ./application/views/Profile.php */