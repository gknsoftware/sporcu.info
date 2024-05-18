<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<section class="container login" id="Login">
		
		<div class="col-md-3">&nbsp;</div>

		<div class="col-md-6">

			<h1 class="text-center">YENİ ŞİFRE TALEBİ</h1>
	
			<?php if ( isset($_GET['is']) ): ?>
				<div class="row <?php echo ( $_GET['is']=='noregister' ) ? 'show' : 'hidden'; ?>">
					<div class="alert alert-dismissible alert-danger col-md-12">
						<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
						<strong>Hata!</strong> Girdiğiniz email adresi sistemde kayıtlı değil.
					</div>
				</div>

				<div class="row <?php echo ( $_GET['is']=='nomatch' ) ? 'show' : 'hidden'; ?>">
					<div class="alert alert-dismissible alert-danger col-md-12">
						<button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
						<strong>Hata!</strong> Bu email adresi tc kimlik no ile eşleşmiyor.
					</div>
				</div>
			<?php endif ?>

			<form class="form-horizontal" id="LoginForm" method="post" action="<?php echo route('login/sendNewPassword/'.$this->uri->segment(3)); ?>">
				<div class="form-group">
					<input type="text" class="form-control input-lg" id="name" name="name" value="<?php echo $this->model_user->get_student_info_tc($this->encrypt->decode($this->uri->segment(3)), 'name').' '.$this->model_user->get_student_info_tc($this->encrypt->decode($this->uri->segment(3)), 'surname'); ?>" readonly>
				<!-- .form-group --> </div>
				<div class="form-group">
					<input type="number" class="form-control input-lg" id="tcno" name="tcno" value="<?php echo $this->encrypt->decode($this->uri->segment(3)); ?>" readonly>
				<!-- .form-group --> </div>
				<div class="form-group">
					<input type="email" class="form-control input-lg" id="email" name="email" size="10" placeholder="Email adresi">
				<!-- .form-group --> </div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary pull-right">Yeni şifre iste</button>
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