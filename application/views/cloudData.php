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
						
						<h3><span style="color: #18bc9c"><?php echo mb_strtoupper($this->model_user->get_student_info($this->uri->segment(3), 'name').' '.$this->model_user->get_student_info($this->uri->segment(3), 'surname'), 'utf-8'); ?></span> KİŞİSİNE VERİ EKLE</h3>
						<form class="cloudDataForm" action="<?php echo route('admin/addCloudData/'); ?>" method="post" enctype="multipart/form-data">
							<div class="form-group input-group">
								<select class="form-control dataStudentList" name="studentList">
									<?php
									foreach ($this->model_user->get_student_list() as $key => $value)
									{
										if ($this->uri->segment(3) == $value->id)
										{
											echo '<option value="'.$value->id.'" selected>'.$value->name.' '.$value->surname.'</option>';
										}
										else
										{
											echo '<option value="'.$value->id.'">'.$value->name.' '.$value->surname.'</option>';
										}
									}
									?>
								</select>
								<span class="input-group-btn">
									<button type="button" class="btn btn-success switchUser" data-userdata="http://www.sporcu.info/admin/cloudData/<?php echo $this->uri->segment(3); ?>"><i class="fa fa-exchange"></i></button>
								</span>
							</div>
							<div class="form-group multiple-form-group input-group">
								<input type="file" name="cloudFiles[]" class="form-control">
								<span class="input-group-btn">
									<button type="button" class="btn btn-success btn-add"><i class="fa fa-plus"></i></button>
								</span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary pull-right addCloudData">Kaydet</button>
							</div>
						</form>

					</div>

					<div class="clearfix"></div>

					<div class="col-md-12">
						<h3><span style="color: #18bc9c"><?php echo mb_strtoupper($this->model_user->get_student_info($this->uri->segment(3), 'name').' '.$this->model_user->get_student_info($this->uri->segment(3), 'surname'), 'utf-8'); ?></span> KİŞİSİNİN VERİLERİ</h3>
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Tür</th>
									<th>Dosya</th>
									<th>İşlem</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($this->model_admin->get_student_file_list($this->uri->segment(3)) as $key => $value) : @$plus++; ?>
									<tr>
										<th><?php echo $plus; ?></th>
										<td><?php echo $value->file_type; ?></td>
										<td>
											<?php if ($value->file_type != 'pdf') : ?>
												<a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" data-placement="left" data-content='<a href="<?php echo get_third('uploads/files/', $value->file_name); ?>" target="_blank"><img src="<?php echo get_third('uploads/files/', $value->file_name); ?>" width="150" class="img-responsive"></a>'>Resmi görüntüle</a>
											<?php else : ?>
												<a href="<?php echo get_third('uploads/files/', $value->file_name); ?>" target="_blank">PDF indir</a>
											<?php endif; ?>
										</td>
										<td><a href="<?php echo route('admin/deleteData/'.$this->uri->segment(3).'/'.$value->file_id); ?>" style="text-decoration:none;" onclick="return confirm('Dosya silinsin mi?')"><span class="label label-danger">Sil</span></a></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
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