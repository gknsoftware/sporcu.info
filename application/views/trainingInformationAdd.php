<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header'); ?>

	<div class="container">

		<section class="filter" id="Filter">

			<div class="col-md-12">

				<h1 style="line-height:1.4em; text-align:center; padding-bottom:2em;">
				<div class="pull-left"><a href="<?php echo route('profile'); ?>" class="backButton"><i class="fa fa-chevron-left"></i></a></div>
				<div class="pull-left" style="padding-left:1em;">ANTRENMAN EKLE</div></h1>
				
				<form action="" method="post">
				<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
					<tbody>
						<tr class="form-group">
							<td>Tarih</td>
							<td>:</td>
							<td><input type="text" class="form-control" name="training_date" placeholder="YYYY-AA-GG" value="<?php echo date('Y-m-h'); ?>"></td>
						</tr>
						<tr class="form-group">
							<td>Saat</td>
							<td>:</td>
							<td><input type="text" class="form-control" name="training_time" placeholder="17:30 - 21:00"></td>
						</tr>
						<tr class="form-group">
							<td>Antrenman adı</td>
							<td>:</td>
							<td><input type="text" class="form-control" name="training_name" placeholder="Yüzme – Ağırlık – Koşu – Fitness"></td>
						</tr>
						<tr class="form-group">
							<td>Açıklama</td>
							<td>:</td>
							<td><textarea class="form-control selectStudent" name="date" rows="10" placeholder="4 X 50 Kurbağalama"></textarea>
						</tr>
						<tr class="form-group">
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr class="form-group">
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr class="form-group">
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr class="form-group">
							<td>Grup adı</td>
							<td>:</td>
							<td><input type="text" class="form-control" id="simpleFilterGroup" name="simpleFilterGroup" placeholder="Hepsi"></td>
						</tr>
					</tbody>
				</table>
				
				<div style="padding:1em 0;" class="clearfix"></div>

				<div class="ui-widget ui-helper-clearfix">
					<ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
						<?php foreach ($this->model_user->get_student_list() as $k => $v) : $expName = explode(' ', ucfirst(mb_strtolower($v->name, 'utf-8'))); ?>
							<li class="ui-widget-content ui-corner-tr" data-filter="<?php echo $v->groupname; ?>" style="padding:0.4em">
								<a href="javascript:void(0);"><img src="<?php echo route($v->picture); ?>">
								<p><small><?php echo $expName[0]; ?></small></p></a>
								<a href="<?php echo route($v->picture); ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
    							<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
							</li>
						<?php endforeach; ?>
					<!-- #gallery --> </ul>

					<div id="trash" class="ui-widget-content ui-state-default">
						<h4 class="ui-widget-header" style="font-weight:normal; padding:10px 0;"><span class="ui-icon ui-icon-trash">Antrenmana gelenler</span> Antrenmana gelenler <span class="incomingCount"></span></h4>
					<!-- #trash --> </div>
				<!-- .ui-widget --> </div>

				<button type="submit" class="btn btn-primary pull-right" style="margin-top: 2em">Kaydet</button>
				<button type="reset" class="btn btn-warning pull-right" style="margin-top: 2em;margin-right: .5em">Temizle</button>
				</form>

			</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file trainingInformation.php */
/* Location: ./application/views/trainingInformation.php */