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
				
				<form action="<?php echo route('admin/send_message_valid'); ?>" method="post">
				<div class="row" style="padding-top: 10%">
					<div class="row">
						<div class="col-md-12">
							<h3>MESAJ YAZIN <a data-toggle="collapse" href="#collapseMessage" aria-expanded="false" aria-controls="collapseMessage" class="pull-right"><i class="fa fa-plus"></i> FORM</a></h3>
							
							<div class="form-group collapsing" id="collapseMessage">
								<select name="msg_title" class="form-control">
									<option value="BILAL AKGOZ">BILAL AKGOZ</option>
									<option value="BYZ KLBK YZ">BYZ KLBK YZ</option>
									<option value="8505857932">8505857932</option>
								</select></p>
								<p><textarea class="form-control" rows="5" name="msg_content" placeholder="Toplu mesaj içeriği" maxlength="160" required></textarea></p>
								<p class="pull-right"><button type="submit" class="btn btn-primary" onclick="return confirm('Onay aşamasına geçilsin mi?')">Gönder</button></p>
							</div>
						</div>
					</div>

					<div class="row col-md-12">
						<h3>KİŞİLERDEN SEÇ</h3>

						<div class="row">
							<div class="col-md-12" id="searchbox" style="margin-bottom: 1em">
							    <form action="#" method="get" novalidate>
							        <div class="input-group">
							            <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
							            <input class="form-control" id="system-search" name="q" placeholder="Başlıklar içerisinde arayın">
							            <span class="input-group-btn">
							                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							            </span>
							        </div>
							    </form>
							<!-- #searchbox --> </div>
						</div>
						
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
													<th><input type="checkbox" id="checkall" /></th>
													<th>Resim</th>
													<th>İsim</th>
													<th>Grup</th>
													<th>Telefon</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($this->model_user->get_student_list() as $key => $value) : ?>
													<tr>
														<td><input type="checkbox" class="checkthis" name="send_valid[]" value="<?php echo $value->mobile; ?>" /></td>
														<td>
																
															<?php if ( $v->picture == '0' ) : ?>

																<?php if ($v->gender == '0'): ?>
																	<img src="<?php echo get_asset('img', 'man.jpg'); ?>" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">
																<?php else : ?>
																	<img src="<?php echo get_asset('img', 'woman.png'); ?>" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">
																<?php endif; ?>
																
															<?php else : ?>
																
																<img src="<?php echo route($value->picture); ?>" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">

															<?php endif; ?>

														</td>
														<td><?php echo ($value->status==1) ? $value->name.' '.$value->surname : '<strike style="color:red">'.$value->name.' '.$value->surname.'</strike>'; ?></td>
														<td><?php echo $value->groupname; ?></td>
														<td><?php echo $value->mobile; ?></td>
													</tr>
												<?php endforeach ?>
											</tbody>
										</table>
									</div>
									<div role="tabpanel" class="tab-pane" id="parents">
										<table class="table table-list-search" id="contentlist_parent">
											<thead>
												<tr>
													<th><input type="checkbox" id="checkall" /></th>
													<th>Öğrenci</th>
													<th>Yakınlık</th>
													<th>Veli</th>
													<th>Telefon</th>
												</tr>
											</thead>
											<tbody>
												<?php
												foreach ($this->model_user->get_student_list() as $key => $value) :
													if( $this->model_user->get_parent_info($value->id, 1, 'mobile') != '' ) : ?>
														<tr>
															<td><input type="checkbox" class="checkthis" name="send_valid_parent[]" value="<?php echo $this->model_user->get_parent_info($value->id, 1, 'mobile'); ?>" /></td>
															<td><?php echo ($value->status==1) ? $value->name.' '.$value->surname : '<strike style="color:red">'.$value->name.' '.$value->surname.'</strike>'; ?></td>
															<td>
																<p><?php echo $this->model_user->get_proximity_name( $this->model_user->get_parent_info($value->id, 1, 'proximity'), 'proximity' ); ?></p>
															</td>
															<td>
																<p><?php echo $this->model_user->get_parent_info($value->id, 1, 'name').' '.$this->model_user->get_parent_info($value->id, 1, 'surname'); ?></p>
															</td>
															<td>
																<p><?php echo $this->model_user->get_parent_info($value->id, 1, 'mobile'); ?></p>
															</td>
														</tr>
													<?php
													endif;

													if( $this->model_user->get_parent_info($value->id, 2, 'mobile') != '' ) : ?>
														<tr>
															<td><input type="checkbox" class="checkthis" name="send_valid_parent[]" value="<?php echo $this->model_user->get_parent_info($value->id, 2, 'mobile'); ?>" /></td>
															<td><?php echo ($value->status==1) ? $value->name.' '.$value->surname : '<strike style="color:red">'.$value->name.' '.$value->surname.'</strike>'; ?></td>
															<td>
																<p><?php echo $this->model_user->get_proximity_name( $this->model_user->get_parent_info($value->id, 2, 'proximity'), 'proximity' ); ?></p>
															</td>
															<td>
																<p><?php echo $this->model_user->get_parent_info($value->id, 2, 'name').' '.$this->model_user->get_parent_info($value->id, 2, 'surname'); ?></p>
															</td>
															<td>
																<p><?php echo $this->model_user->get_parent_info($value->id, 2, 'mobile'); ?></p>
															</td>
														</tr>
													<?php endif; ?>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
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