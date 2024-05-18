<?php
$expMonth = $trainingYear;

$diffArr = array();    // ID
$sencDate = array();   // Antrenman tarihler
foreach ($this->model_user->get_training_list() as $k => $v)
{
	$expDate = explode('-', $v->date);
	$yearAndMonth = $expDate[0];

	if ($yearAndMonth == $trainingYear)
	{
    $sencDate[$v->id] = null;
		foreach ($this->model_user->get_incoming_list($v->id) as $k_2 => $v_2)
		{
			$diffArr[] = $v_2->student_id;
      $sencDate[$v_2->training_id][] .= $v_2->student_id;
  	}
	}
}

$incomingMonth = array();
for ($i=1; $i <= 12; $i++) { 
  $incomingMonth[$i] = $i;
}
//print_r($incomingMonth);

$incomingDay = array();
for ($i=1; $i <= 31; $i++) { 
  $incomingDay[$i] = $i;
}
//print_r($incomingDay);

//print_r($sencDate);
//print_r($diffArr);

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Antrenman Listesi</title>
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <th height="42" colspan="35" align="center" valign="middle" scope="row">ANKARA KEÇİÖREN BELEDİYESİ BAĞLUM SPOR KULÜBÜ DERNEĞİ KURSİYER DEVAM ÇİZELGESİ</th>
    </tr>
    <tr>
      <th colspan="35" scope="row">&nbsp;</th>
    </tr>
    <tr>
      <th height="29" colspan="35" align="left" scope="row"><span style="width:140px;display:inline-block">ANTRENÖR ADI</span>: BİLAL AKGÖZ</th>
    </tr>
    <tr>
      <th height="29" colspan="35" align="left" scope="row"><span style="width:140px;display:inline-block">GRUP ADI</span>: <?php echo ucfirst(urldecode($this->uri->segment(4))); ?></th>
    </tr>
    <tr>
      <th colspan="35" scope="row">&nbsp;</th>
    </tr>
    <tr>
    	<th colspan="35" scope="row">
        <table width="100%" border="1" cellspacing="0" cellpadding="2">
        	<tbody>
                <tr>
                  <th width="2%" rowspan="2" align="center" scope="row"><strong>Sıra</strong></th>
                  <td width="42%" rowspan="2" align="center"><strong>Kursiyerin<br />Adı Soyadı</strong></td>
                  <td rowspan="2" align="center"><strong>Doğum Tarihi</strong></td>
                  <td colspan="34" align="center"><strong><?php echo $expMonth; ?> YILI</strong></td>
                </tr>
                <tr>
                  <td width="2%" align="center"><strong>Ocak</strong></td>
                  <td width="2%" align="center"><strong>Şubat</strong></td>
                  <td width="2%" align="center"><strong>Mart</strong></td>
                  <td width="2%" align="center"><strong>Nisan</strong></td>
                  <td width="2%" align="center"><strong>Mayıs</strong></td>
                  <td width="2%" align="center"><strong>Haziran</strong></td>
                  <td width="2%" align="center"><strong>Temmuz</strong></td>
                  <td width="2%" align="center"><strong>Ağustos</strong></td>
                  <td width="2%" align="center"><strong>Eylül</strong></td>
                  <td width="2%" align="center"><strong>Ekim</strong></td>
                  <td width="2%" align="center"><strong>Kasım</strong></td>
                  <td width="2%" align="center"><strong>Aralık</strong></td>
                   <td width="2" align="center"><strong>Toplam</strong></td>
                  <?php if ( isset($trainingStudentPic) ): ?>
                    <td align="center"><strong>Bilgiler</strong></td>
                    <td align="center"><strong>Resim</strong></td>
                  <?php endif; ?>
                </tr>
                <?php
                foreach (array_unique($diffArr) as $p) { 
                	if ($this->model_user->get_student_info($p, 'groupname') == ucfirst(urldecode($trainingGroup)))
                	{
                		@$plus++; ?>
						<tr>
							<th scope="row"><?php echo $plus; ?></th>
							<td align="left"><?php echo $this->model_user->get_student_info($p, 'name').' '.$this->model_user->get_student_info($p, 'surname'); ?></td>
              				<td align="left"><?php echo $this->model_user->get_student_info($p, 'birthdate'); ?></td>
							<?php
							$selectedDate = array();
              				$selectedDateCount = array();
							foreach ($this->model_user->get_incoming_list(null, $p) as $k => $v)
							{
								$expDate = explode('-', $this->model_user->get_training_info($v->training_id, 'date'));

								if ($trainingYear == $expDate[0])
								{
									$selectedDate[ltrim($expDate[1], '0')][] = ltrim($expDate[1], '0');
                  					$selectedDateCount[] = ltrim($expDate[1], '0');
								}
							}

							foreach ($incomingMonth as $key => $value)
							{
								if ( array_key_exists($value, $selectedDate) )
								{
									//eşitle
									echo '<td>'.count($selectedDate[$key]).'</td>';
								}
								else
								{
									echo '<td>&nbsp;</td>';
								}
							}
							?>
							<td><?php echo count($selectedDateCount); ?></td>
							<?php if ( isset($trainingStudentPic) ): ?>
							<td>
							<?php

							if ( $this->model_user->get_parent_info($p, 1, 'mobile') != '' ) {
								echo '<p>'.$this->model_user->get_proximity_name( $this->model_user->get_parent_info($p, 1, 'proximity'), 'proximity' ); ?> tel: <?php echo $this->model_user->get_parent_info($p, 1, 'mobile').'</p>';
							}

							if ( $this->model_user->get_parent_info($p, 2, 'mobile') != '' ) {
								echo '<p>'.$this->model_user->get_proximity_name( $this->model_user->get_parent_info($p, 2, 'proximity'), 'proximity' ); ?> tel: <?php echo $this->model_user->get_parent_info($p, 2, 'mobile').'</p>';
							}

							?>
							</td>
							<td><img src="<?php echo route($this->model_user->get_student_info($p, 'picture')); ?>" width="75" height="75" /></td>
							<?php endif; ?>
						</tr>
            	<?php
            		}
            	} ?>
			</tbody>
        </table>
      </th>
    </tr>
  </tbody>
</table>

</body>
</html>
