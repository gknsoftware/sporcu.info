<?php foreach ($this->model_user->training_senc_students_list($_GET['id']) as $k => $v): ?>
	<div class="col-md-3" style="text-align: center;">
		<img src="<?php echo route($this->model_user->get_student_info($v->student_id, 'picture')); ?>" alt="Resim" width="81" height="107">
		<p style="padding-top: .5em;"><?php echo $this->model_user->get_student_info($v->student_id, 'name').' '.$this->model_user->get_student_info($v->student_id, 'surname'); ?></p>
		<p><a href="<?php echo route('profile/delete_single_incoming_student/'.$v->student_id.'/'.$_GET['id']); ?>" class="label label-danger" onclick="return confirm('Öğrenci antrenmandan silinsin mi?')">SİL</a></p>
	</div>
<?php endforeach ?>