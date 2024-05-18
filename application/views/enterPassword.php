<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<section class="container login" id="Login">
		
		<div class="col-md-3">&nbsp;</div>

		<div class="col-md-6">

			<h1 class="text-center">GİRİŞ EKRANI</h1>

			<form class="form-horizontal" id="LoginForm" method="post" action="<?php echo route('login/enterPassword'); ?>">
				<div class="form-group">
					<input type="text" class="form-control input-lg" id="name" name="name" value="<?php echo $this->model_user->get_student_info_tc($this->input->post('tcno'), 'name').' '.$this->model_user->get_student_info_tc($this->input->post('tcno'), 'surname'); ?>" readonly>
				<!-- .form-group --> </div>
				<div class="form-group">
					<input type="number" class="form-control input-lg" id="tcno" name="tcno" value="<?php echo $this->input->post('tcno'); ?>" readonly>
				<!-- .form-group --> </div>
				<div class="form-group">
					<input type="password" class="form-control input-lg" id="password" name="password" size="10" placeholder="Şifreniz">
				<!-- .form-group --> </div>
				<div class="form-group">
					<small><a href="<?php echo route('login/forgotPassword/'.$this->encrypt->encode($this->input->post('tcno'))); ?>">Şifrenizi mi unuttunuz?</a></small>
					<button type="submit" class="btn btn-primary pull-right">Giriş yap</button>
				<!-- .form-group --> </div>
			<!-- form --> </form>

		</div>

		<div class="col-md-3">&nbsp;</div>

	</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file EnterPassword.php */
/* Location: ./application/controllers/EnterPassword.php */