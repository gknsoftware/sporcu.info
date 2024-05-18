<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<section class="container login" id="Login">
		
		<div class="col-md-3">&nbsp;</div>

		<div class="col-md-6">

			<h1 class="text-center">ŞİFRE OLUŞTURUN</h1>

			<?php if ($this->uri->segment(2) == 'createNewPassword'): ?>
				<div class="alert alert-dismissible alert-danger hideResult <?php echo form_valid(validation_errors(), 'show'); ?>">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo combine_valid_message(array('password', 'passconf')); ?>
				</div>
			<?php endif ?>

			<form class="form-horizontal" id="form-password" method="post" action="<?php echo route('login/createNewPassword'); ?>" novalidate>
				<div class="form-group">
					<input type="text" class="form-control input-lg" id="name" name="name" value="<?php echo $this->input->post('name').' '.$this->input->post('surname') ?>" readonly>
				<!-- .form-group --> </div>
				<div class="form-group">
					<input type="number" class="form-control input-lg" id="tcno" name="tcno" value="<?php echo $this->input->post('tcno'); ?>" readonly>
				<!-- .form-group --> </div>
				<div class="form-group" data-validate="required" data-validtext="Lütfen bir şifre belirleyin.">
					<input type="text" class="form-control input-lg" id="password" name="password" size="10" placeholder="Şifreniz" autocomplete="off">
					<p class="text-danger validtext"></p>
				<!-- .form-group --> </div>
				<div class="form-group" data-validate="required" data-validtext="Lütfen şifrenizi tekrar yazın.">
					<input type="text" class="form-control input-lg" id="passconf" name="passconf" size="10" placeholder="Şifreniz (Tekrar)" autocomplete="off">
					<p class="text-danger validtext"></p>
				<!-- .form-group --> </div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary pull-right" data-loading-text="Bekleyin..." id="formvalid" data-form="password">Giriş yap</button>
				<!-- .form-group --> </div>
			<!-- form --> </form>

		</div>

		<div class="col-md-3">&nbsp;</div>

	</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file CreateNewPassword.php */
/* Location: ./application/controllers/CreateNewPassword.php */