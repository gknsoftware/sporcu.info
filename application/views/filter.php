<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<div class="container">

		<section class="filter" id="Filter">

			<div class="col-md-12">

				<h1 style="line-height:1.4em; text-align:center; padding-bottom:.8em;">
				<div class="pull-left"><a href="<?php echo route('profile'); ?>" class="backButton"><i class="fa fa-chevron-left"></i></a></div>
				<div class="pull-left" style="padding-left:1.5em;">SPORCU FİLTRELEME</div></h1>
				
				<div style="margin: 5em 0;">
					<div class="col-md-12">
						<p><strong>Özel filtreleme</strong></p>
						<div class="btn-group">
							<a href="javascript:void(0);" class="btn btn-default">Tür</a>
							<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo route('profile/filters'); ?>" target="_blank">Hepsi</a></li>
								<li><a href="<?php echo route('profile/filters/1'); ?>" target="_blank">Gelenler</a></li>
								<li><a href="<?php echo route('profile/filters/0'); ?>" target="_blank">Gelmeyenler</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-12" style="padding-top: 2em;">
						<form method="post" action="javascript:void(0);" id="filterForm">
							<div class="form-group">
								<label for="exampleInputEmail1">Filtre türü</label>
								<select name="filterType" id="filterType" class="form-control">
									<option value="0">Filtreleme seçin</option>
									<option value="group">Grup</option>
									<option value="birthyear">Doğum Yılı</option>
									<option value="teacher">Eğitmen</option>
									<option value="lisance">Lisans</option>
								</select>
							</div>
							<div class="form-group filterText hidden" id="filterGroup">
								<label for="filterText">Grup adı</label>
								<input type="text" class="form-control" id="filterGroup" name="filterGroup" placeholder="Sabahçılar">
							</div>
							<div class="form-group filterText hidden" id="filterBirthyear">
								<label for="filterGroup">Doğum yılı</label>
								<input type="text" class="form-control" id="filterGroup" name="filterBirthyear" placeholder="1991">
							</div>
							<div class="form-group filterText hidden" id="filterTeacher">
								<label for="filterTeacher">Eğitmen</label>
								<input type="text" class="form-control" id="filterTeacher" name="filterTeacher" placeholder="İsim SOYİSİM">
							</div>
							<div class="form-group filterText hidden" id="filterLisance">
								<label for="filterLisance">Lisans durumu</label>
								<select name="filterLisance" id="filterLisance" class="form-control">
									<option value="x">Lisans durumu seçin</option>
									<option value="1">Var</option>
									<option value="0">Yok</option>
								</select>
							</div>
						</form>
					</div>
				</div>

				<div id="filterTitle" class="bg bg-warning hidden"> </div>
				<div id="filterLoad"> </div>		

			</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file editInfo.php */
/* Location: ./application/views/editInfo.php */