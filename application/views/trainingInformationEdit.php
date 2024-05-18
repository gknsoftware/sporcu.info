<?php defined('BASEPATH') OR exit('No direct script access allowed');

//Layout: Header
$this->load->view('layout/header');

$expDate = explode('-', $this->model_user->get_training_info($_GET['id'], 'date'));
?>

	<div class="container">

		<section class="filter" id="Filter">

			<div class="col-md-12">

				<h1 style="line-height:1.4em; text-align:center; padding-bottom:2em;">
				<div class="pull-left"><a href="<?php echo route('profile/trainingInformationList'); ?>" class="backButton"><i class="fa fa-chevron-left"></i></a></div>
				<div class="pull-left" style="padding-left:1em;">ANTRENMAN <span style="color:#18BC9C;"><?php echo $expDate[2].' '.mb_strtoupper(change_months($expDate[1]), 'utf-8').' '.$expDate[0]; ?></span></div></h1>

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#addIncoming" aria-controls="addIncoming" role="tab" data-toggle="tab">Öğrenci Ekle</a></li>
					<li role="presentation"><a href="#incoming" aria-controls="incoming" role="tab" data-toggle="tab">Antrenmana Gelenler</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="addIncoming">
						<?php $this->load->view('addIncomingStudent'); ?>
						
						<h3>ANTRENMAN BİLGİSİ</h3>
						<form action="<?php echo route('profile/trainingInformationEdit?id='.$_GET['id'].''); ?>" method="post">
						<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
							<tbody>
								<tr class="form-group">
									<td>Tarih</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="training_date" placeholder="YYYY-AA-GG" value="<?php echo $this->model_user->get_training_info($_GET['id'], 'date'); ?>"></td>
								</tr>
								<tr class="form-group">
									<td>Saat</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="training_time" placeholder="17:30 - 21:00" value="<?php echo $this->model_user->get_training_info($_GET['id'], 'time'); ?>"></td>
								</tr>
								<tr class="form-group">
									<td>Antrenman adı</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="training_name" placeholder="Yüzme – Ağırlık – Koşu – Fitness" value="<?php echo $this->model_user->get_training_info($_GET['id'], 'training_name'); ?>"></td>
								</tr>
								<tr class="form-group">
									<td>Açıklama</td>
									<td>:</td>
									<td><textarea class="form-control selectStudent" name="training_description" rows="20" placeholder="4 X 50 Kurbağalama"><?php echo $this->model_user->get_training_info($_GET['id'], 'training_description'); ?></textarea>
								</tr>
							</tbody>
						</table>

						<button type="submit" class="btn btn-primary pull-right" style="margin-top: 2em">Kaydet</button>
						<button type="reset" class="btn btn-warning pull-right" style="margin-top: 2em;margin-right: .5em">Temizle</button>
						<a href="<?php echo route('profile/delete_training/'.$_GET['id']); ?>"><button type="button" class="btn btn-danger pull-right" style="margin-top: 2em;margin-right: .5em" onclick="return confirm('Antrenman silinsin mi?');">Sil</button></a>
						</form>
					</div>

					<div role="tabpanel" class="tab-pane" id="incoming">
						<?php $this->load->view('listIncomingStudent'); ?>
					</div>
				</div>

			</div>

		</section>

<?php
//Layout: Footer
$this->load->view('layout/footer');

/* End of file trainingInformation.php */
/* Location: ./application/views/trainingInformation.php */