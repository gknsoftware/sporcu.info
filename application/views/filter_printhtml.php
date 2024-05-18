<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo ucfirst(urldecode($this->uri->segment(3))); ?> grup öğrenci listesi</title>
</head>

<body>
<table width="1000" border="0" cellpadding="0" cellspacing="0" align="center">
  <tbody>
    <tr>
		<?php
		$data = $this->model_user->filter_group( urldecode($this->uri->segment(3)) );

		$returned = '';
		if ($data)
		{
			$counter = 0;
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

				$nStatus = ( $this->model_user->get_option('filterStudentStatus') == 'yes' ) ? 0 : 1;
				if ($v->status == $nStatus)
				{
					$returned .= '<td style="text-align:center;">';
						if ( $v->picture == '0' ) :

							if ($v->gender == '0'):
								$returned .= '<img src="'.get_asset('img', 'man.jpg').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
							else :
								$returned .= '<img src="'.get_asset('img', 'woman.png').'" width="175" height="175" style="border: 1px solid #ccc; padding: 2px;">';
							endif;
							
						else :
							
							$returned .= '<img src="'.base_url().$v->picture.'" width="135" height="175" style="border: 1px solid #ccc; padding: 2px;">';

						endif;

						$returned .= '<p style="padding-top: .8em;">';
							$returned .= '<strong>'.$v->name.' '.$v->surname.'</strong>';
							$returned .= '<small style="display: block;">';
								$returned .= $v->gender==0 ? 'Erkek' : 'Kadın';
								$returned .=  " / ($age)";
								$returned .= '<br />'.$v->birthdate;
								$returned .=  '<br /><span class="label label-info">'.$this->model_user->get_branch_name($v->branch, 'branch_name').' '.$this->model_user->get_Student_Info($v->id, 'lisance').'</span>';
								$returned .= '<br />'.$studentMobile;
								$returned .= '<br />'.$this->model_user->get_proximity_name($parent_1, 'proximity').': '.$parent_1_mobile;
								$returned .= ($getParent_2_Mobile!='') ? '<br />'.$this->model_user->get_proximity_name($parent_2, 'proximity').': '.$parent_2_mobile : null;
							$returned .= '</small>
						</p>
					</td>';

					$counter++;
					if ($counter > 3) {
						$returned .= '</tr><tr>';

						$counter = 0;
					}
				}
			}
		}

		echo $returned;
		?>
    </tr>
  </tbody>
</table>

</body>
</html>