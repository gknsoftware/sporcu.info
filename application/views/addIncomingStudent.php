<table width="100%" cellspacing="0" cellpadding="0" class="pull-left td-padding-tb-5">
	<tbody>
		<tr class="form-group">
			<td>Grup adı</td>
			<td>:</td>
			<td><input type="text" class="form-control" id="simpleFilterGroup" name="simpleFilterGroup" placeholder="Hepsi"></td>
		</tr>
	</tbody>
</table>

<div class="clearfix" style="padding:3em 0;"></div>

<div class="ui-widget ui-helper-clearfix">
	<ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
		<?php
		foreach ($this->model_user->get_student_list() as $k => $v) {
			$expName = explode(' ', ucfirst(mb_strtolower($v->name, 'utf-8')));
			if ( $v->status == 1 ) {
		?>
			<li class="ui-widget-content ui-corner-tr" data-filter="<?php echo $v->groupname; ?>" style="padding:0.4em" data-student-id="<?php echo $v->id; ?>" data-training-id="<?php echo $_GET['id']; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $v->name.' '.$v->surname; ?>">
				<a href="javascript:void(0);"><img src="<?php echo route($v->picture); ?>">
				<p><small><?php echo $expName[0]; ?></small></p></a>
				<a href="<?php echo route($v->picture); ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
				<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
			</li>
		<?php }} ?>
	<!-- #gallery --> </ul>

	<div id="trash" class="ui-widget-content ui-state-default">
		<h4 class="ui-widget-header" style="font-weight:normal; padding:10px 0;"><span class="ui-icon ui-icon-trash">Antrenmana gelenler</span> Antrenmana gelenler <span class="incomingCount"></span></h4>
	<!-- #trash --> </div>
<!-- .ui-widget --> </div>