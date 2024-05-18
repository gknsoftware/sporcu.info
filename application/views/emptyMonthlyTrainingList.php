<?php
$expMonth = explode('-', $trainingMonth);

$diffArr = array();    // ID
$sencDate = array();   // Antrenman tarihler
foreach ($this->model_user->get_training_list() as $k => $v)
{
	$expDate = explode('-', $v->date);
	$yearAndMonth = $expDate[0].'-'.$expDate[1];

	if ($yearAndMonth == $trainingMonth)
	{
    $sencDate[$v->id] = null;
		foreach ($this->model_user->get_incoming_list($v->id) as $k_2 => $v_2)
		{
			$diffArr[] = $v_2->student_id;
      $sencDate[$v_2->training_id][] .= $v_2->student_id;
  	}
	}
}

$incomingDay = array();
for ($i=1; $i <= 31; $i++) { 
  $incomingDay[$i] = $i;
}
//print_r($incomingDay);

//print_r($sencDate);
//print_r($diffArr);

?>
<!doctype html>
<html class="emptyMonthlyTrainingList">
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
                  <td colspan="34" align="center"><strong><?php echo $expMonth[0].' '.mb_strtoupper(change_months($expMonth[1]), 'utf-8'); ?></strong></td>
                </tr>
                <tr>
                  <td width="1%" align="center"><strong>1</strong></td>
                  <td width="1%" align="center"><strong>2</strong></td>
                  <td width="1%" align="center"><strong>3</strong></td>
                  <td width="1%" align="center"><strong>4</strong></td>
                  <td width="1%" align="center"><strong>5</strong></td>
                  <td width="1%" align="center"><strong>6</strong></td>
                  <td width="1%" align="center"><strong>7</strong></td>
                  <td width="1%" align="center"><strong>8</strong></td>
                  <td width="1%" align="center"><strong>9</strong></td>
                  <td width="1%" align="center"><strong>10</strong></td>
                  <td width="1%" align="center"><strong>11</strong></td>
                  <td width="1%" align="center"><strong>12</strong></td>
                  <td width="1%" align="center"><strong>13</strong></td>
                  <td width="1%" align="center"><strong>14</strong></td>
                  <td width="1%" align="center"><strong>15</strong></td>
                  <td width="1%" align="center"><strong>16</strong></td>
                  <td width="1%" align="center"><strong>17</strong></td>
                  <td width="1%" align="center"><strong>18</strong></td>
                  <td width="1%" align="center"><strong>19</strong></td>
                  <td width="1%" align="center"><strong>20</strong></td>
                  <td width="1%" align="center"><strong>21</strong></td>
                  <td width="1%" align="center"><strong>22</strong></td>
                  <td width="1%" align="center"><strong>23</strong></td>
                  <td width="1%" align="center"><strong>24</strong></td>
                  <td width="1%" align="center"><strong>25</strong></td>
                  <td width="1%" align="center"><strong>26</strong></td>
                  <td width="1%" align="center"><strong>27</strong></td>
                  <td width="1%" align="center"><strong>28</strong></td>
                  <td width="1%" align="center"><strong>29</strong></td>
                  <td width="1%" align="center"><strong>30</strong></td>
                  <td width="2%" align="center"><strong>31</strong></td>
                  <?php if ( isset($_GET['pic']) ): ?>
                    <td align="center"><strong>Bilgiler</strong></td>
                    <td align="center"><strong>Resim</strong></td>
                  <?php endif; ?>
                </tr>
                <?php
                foreach (array_unique($diffArr) as $p) { 
                	if ($this->model_user->get_student_info($p, 'groupname') == ucfirst(urldecode($trainingGroup)))
                	{
                		@$plus++;?>
						
						<tr>
							<th scope="row"><?php echo $plus; ?></th>
							<td align="left"><?php echo $this->model_user->get_student_info($p, 'name').' '.$this->model_user->get_student_info($p, 'surname'); ?></td>
							<td align="left"><?php echo $this->model_user->get_student_info($p, 'birthdate'); ?></td>
							<?php
							$newDayArr = array();
							foreach ($this->model_user->get_incoming_list(null, $p) as $k => $v)
							{
								$expDate = explode('-', $this->model_user->get_training_info($v->training_id, 'date'));
								$yearAndMonth = $expDate[0].'-'.$expDate[1];

								if ($yearAndMonth == $trainingMonth)
								{
									$expDay = explode('-', $this->model_user->get_training_info($v->training_id, 'date'));
									$newDayArr[ltrim($expDay[2],'0')] = ltrim($expDay[2],'0');                    
								}
							}

							foreach ($incomingDay as $key => $value)
							{
								if ( array_key_exists($value, $newDayArr) ) {
									echo '<td>&nbsp;</td>';
								}else{
									echo '<td>&nbsp;</td>';
								}
							}
							?>
							<?php if ( isset($_GET['pic']) ): ?>
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
