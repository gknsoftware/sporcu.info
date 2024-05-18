<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<div class="container">

		<section class="register" id="Register">
			<div class="col-md-12">

				<h1 style="line-height:1.4em; text-align:left;padding-bottom:.8em;">
				<div class="pull-left"><a href="<?php echo route('profile'); ?>" class="backButton"><i class="fa fa-chevron-left"></i></a></div>
				<div class="pull-left" style="padding-left: .6em">ÖĞRENCİ LİSTESİ | TOPLAM: <?php echo count($student_list); ?></h1>
				
				<?php foreach ($student_list as $k => $v) :

					//Explode data
					if ( strstr($v->birthdate,'/') ) {
						$expBirth = explode('/', $v->birthdate);
					}
					elseif ( strstr($v->birthdate,'.') ) {
						$expBirth = explode('.', $v->birthdate);
					}
					elseif ( strstr($v->birthdate,'-') ) {
						$expBirth = explode('-', $v->birthdate);
					}

					$checkLisance = ($this->model_user->get_Student_Info($v->id, 'lisance') != '') ? ': ' . $this->model_user->get_Student_Info($v->id, 'lisance') : null;

					//Check status to students
					$strikeClass = ($v->status==0) ? 'text-decoration: line-through;color:red' : null;
					$disabledText = ($v->status==0) ? $this->model_user->get_branch_name($v->branch, 'branch_name').' - İZİNLİ' : $this->model_user->get_branch_name($v->branch, 'branch_name').$checkLisance;
					$intStatus = ($v->status==0) ? 1 : 0;
					?>
					
					<div class="col-md-3 col-sm-6 col-xs-12 text-center hover-box">
						<ul class="simple_hover_menu" id="hover-menu-<?php echo $k+1; ?>">
							<li class="change_status"><a href="<?php echo route('profile/updateStatus/'.$v->id.'/'.$intStatus); ?>" onclick="return confirm('Öğrenci durumu değiştirilsin mi?')"><i class="fa fa-pause"></i></a></li>
						</ul>
						<?php if ( $v->picture == '0' ) : ?>

							<?php if ($v->gender == '0'): ?>
								<a href="showStudentInfo/<?php echo $v->id; ?>" target="_blank"><img src="<?php echo get_asset('img', 'man.jpg'); ?>" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;"></a>
							<?php else : ?>
								<a href="showStudentInfo/<?php echo $v->id; ?>" target="_blank"><img src="<?php echo get_asset('img', 'woman.png'); ?>" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;"></a>
							<?php endif; ?>
							
						<?php else : ?>
							
							<a href="showStudentInfo/<?php echo $v->id; ?>" target="_blank"><img src="<?php echo route($v->picture); ?>" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;"></a>

						<?php endif; ?>

						<p style="padding-top: .8em; <?php echo $strikeClass; ?>">
							<a href="showStudentInfo/<?php echo $v->id; ?>" target="_blank" style="<?php echo $strikeClass; ?>"><?php echo $v->name.' '.$v->surname; ?></a>
							<small style="display: block;">
								<?php
								echo $v->gender==0 ? 'Erkek' : 'Kadın';
								echo ' / '.$expBirth[2];
								echo '<br />'.$disabledText;
								echo '<br />'.change_label($this->model_user->get_Student_Info($v->id, 'groupname'));
								?>
							</small>
						</p>
					</div>

				<?php endforeach; ?>

			<!-- .col-md-12 --> </div>
		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file editInfo.php */
/* Location: ./application/views/editInfo.php */