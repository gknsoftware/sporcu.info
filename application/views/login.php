<?php $this->load->view('layout/header'); ?>
	
	<div class="container">
		<section class="login" id="Login">
			
			<div class="col-md-3">&nbsp;</div>

			<div class="col-md-6">

				<h1 class="text-center">SPORCU SORGULA</h1>

				<form class="form-horizontal" id="form-login" method="post" action="<?php echo route('login'); ?>" novalidate>
					<div class="form-group" data-validate="required" data-validtext="Alan boş olamaz">
						<input type="text" class="form-control input-lg tcno" id="tcno" name="tcno" size="10" placeholder="11 haneli tc kimlik numarası" pattern="([0-9]|[0-9]|[0-9])" maxlength="11" autocomplete="off">
						<small id="wrongTC" class="validtext"><?php echo combine_valid_message(array('tcno')); ?></small>
						<small id="registered" class="validtext"><?php echo combine_valid_message(array('tcno')); ?></small>
						<p class="text-danger validtext"></p>
					<!-- .form-group --> </div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary pull-right" data-loading-text="Bekleyin..." id="formvalid" data-form="login">Sorgula</button>
					<!-- .form-group --> </div>
				<!-- form --> </form>

			</div>

			<div class="col-md-3">&nbsp;</div>

		</section>

<?php $this->load->view('layout/footer'); ?>