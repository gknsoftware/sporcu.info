<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Filtrelenecek Öğrenci Listesi</title>
<style type="text/css">
	#searchbox input{
		width: 100%;
		height: 35px;
		margin: 0 auto;
		font-size: 100%;
	}

	.btn-group{
		float: right;
		margin-bottom: .5em;
	}
	.btn-group a{
		color: #000;
		font-size: 100%;
		font-family: Arial, Helvetica, sans-serif;
		text-decoration: none;
		margin-left: 1em
	}
	.table-list-search{
		border: 1px solid #eee;
	}
	.table-list-search tr td{
		text-align: center;
	}
	.table-list-search tr td, .table-list-search tr th{
		border: 1px solid #eee;
	}
	.table-list-search tr th{
		padding: .4em 0;
	}
</style>
</head>

<body>
<table width="1000" border="0" cellpadding="0" cellspacing="0" align="center" style="padding: 1em 0 2em 0;" id="livesearch">
	<tbody>
		<tr>
			<td>
				<span class="btn-group close_ls"><a href="javascript:void(0);">KAPAT</a></span>
				<span class="btn-group print_ls"><a href="javascript:void(0);">YAZDIR</a></span>

				<div id="searchbox">
					<form action="#" method="get" novalidate>
					    <div class="input-group">
					        <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
					        <input id="filter-search" name="q" placeholder="Filtreleme">
					    </div>
					</form>
				<!-- #searchbox --> </div>
			</td>
		</tr>
	</tbody>
</table>


<table width="1000" border="0" cellpadding="0" cellspacing="0" align="center" class="table-list-search">
	<thead>
		<tr>
	  		<th>Resim</th>
	  		<th>Ad, Soyad</th>
	  		<th>Cinsiyet</th>
	  		<th>Doğum Tarihi</th>
	  		<th>Branş</th>
	  		<th>Lisans</th>
	  		<th>Telefon</th>
	  		<th>Veliler</th>
	  		<th>Grup</th>
	  	</tr>
	</thead>

	<tbody>
		<tr>
			<?php
			$data = $this->model_user->get_student_list();

			$returned = '';
			if ($data)
			{
				foreach ($data as $k => $v) 
				{
					//Explode data
					if ( strstr($v->birthdate,'/') ) {
						$expBirth = explode('/', $v->birthdate);
						$age = date('Y') - $expBirth[2];
					}
					elseif ( strstr($v->birthdate,'.') ) {
						$expBirth = explode('.', $v->birthdate);
						$age = date('Y') - $expBirth[2];
					}
					elseif ( strstr($v->birthdate,'-') ) {
						$expBirth = explode('-', $v->birthdate);
						$age = date('Y') - $expBirth[2];
					}

					//Explode Student Mobile
					$studentMobile = substr($v->mobile,0,4);
					$studentMobile .= ' '.substr($v->mobile,4,3);
					$studentMobile .= ' '.substr($v->mobile,7,2);
					$studentMobile .= ' '.substr($v->mobile,9,2);

					//Explode Parent Mobile
					$getParent_1_Mobile = $this->model_user->get_parent_info($v->id, 1, 'mobile');
					$getParent_2_Mobile = $this->model_user->get_parent_info($v->id, 2, 'mobile');

					//Parent 1 mobile
					$parent_1_mobile = substr($getParent_1_Mobile,0,4);
					$parent_1_mobile .= ' '.substr($getParent_1_Mobile,4,3);
					$parent_1_mobile .= ' '.substr($getParent_1_Mobile,7,2);
					$parent_1_mobile .= ' '.substr($getParent_1_Mobile,9,2);

					//Parent 2 mobile
					$parent_2_mobile = substr($getParent_2_Mobile,0,4);
					$parent_2_mobile .= ' '.substr($getParent_2_Mobile,4,3);
					$parent_2_mobile .= ' '.substr($getParent_2_Mobile,7,2);
					$parent_2_mobile .= ' '.substr($getParent_2_Mobile,9,2);

					//Get student parent
					$parent_1 = $this->model_user->get_parent_info($v->id, 1, 'proximity');
					$parent_2 = $this->model_user->get_parent_info($v->id, 2, 'proximity');

					if ($status != '')
					{
						if ($status == $v->status)
						{
							$returned .= '
							<tr>
								<td style="text-align:center;">';
									if ( $v->picture == '0' ) :

										if ($v->gender == '0') :
											$returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">';
										else :
											$returned .= '<img src="'.get_asset('img', 'woman.png').'" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">';
										endif;
										
									else :
										
										$returned .= '<img src="'.base_url().$v->picture.'" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">';

									endif;

								$returned .= '</td>';
								$returned .= '<td>'.$v->name.' '.$v->surname.'</td>';
								$returned .= $v->gender==0 ? '<td>Erkek</td>' : '<td>Kadın</td>';
								$returned .= '<td>'.$v->birthdate.' ('.$age.')'.'</td>';
								$returned .= '<td>'.$this->model_user->get_branch_name($v->branch, 'branch_name').'</td>';
								$returned .= '<td>'.$this->model_user->get_student_info($v->id, 'lisance').'</td>';
								$returned .= '<td>'.$studentMobile.'</td>';
								$returned .= '<td>'.$this->model_user->get_proximity_name($parent_1, 'proximity').': '.$parent_1_mobile.'<br />';
								$returned .= ($getParent_2_Mobile!='') ? $this->model_user->get_proximity_name($parent_2, 'proximity').': '.$parent_2_mobile.'</td>' : null;
								$returned .= '<td>'.$v->groupname.'</td>';

							$returned .= '</tr>';
						}	
					}
					else
					{
						$returned .= '
						<tr>
							<td style="text-align:center;">';
								if ( $v->picture == '0' ) :

									if ($v->gender == '0') :
										$returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">';
									else :
										$returned .= '<img src="'.get_asset('img', 'woman.png').'" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">';
									endif;
									
								else :
									
									$returned .= '<img src="'.base_url().$v->picture.'" width="50" height="60" style="border: 1px solid #ccc; padding: 2px;">';

								endif;

							$returned .= '</td>';
							$returned .= '<td>'.$v->name.' '.$v->surname.'</td>';
							$returned .= $v->gender==0 ? '<td>Erkek</td>' : '<td>Kadın</td>';
							$returned .= '<td>'.$v->birthdate.' ('.$age.')'.'</td>';
							$returned .= '<td>'.$this->model_user->get_branch_name($v->branch, 'branch_name').'</td>';
							$returned .= '<td>'.$this->model_user->get_student_info($v->id, 'lisance').'</td>';
							$returned .= '<td>'.$studentMobile.'</td>';
							$returned .= '<td>'.$this->model_user->get_proximity_name($parent_1, 'proximity').': '.$parent_1_mobile.'<br />';
							$returned .= ($getParent_2_Mobile!='') ? $this->model_user->get_proximity_name($parent_2, 'proximity').': '.$parent_2_mobile.'</td>' : null;
							$returned .= '<td>'.$v->groupname.'</td>';

						$returned .= '</tr>';	
					}

				}
			}

			echo $returned;
			?>
		</tr>
	</tbody>
</table>

	<script src="<?php echo get_asset('js', 'jquery-1.11.3.js'); ?>"></script>
	<script src="<?php echo get_asset('js', 'filter.js'); ?>"></script>
</body>
</html>