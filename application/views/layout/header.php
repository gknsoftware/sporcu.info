<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Öğrenci Kayıt</title>
	<link rel="stylesheet" href="<?php echo get_asset('css', 'bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo get_asset('css', 'normalize.css'); ?>">
	<link rel="stylesheet" href="<?php echo get_asset('css', 'jquery-ui.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo get_asset('css', 'font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo get_asset('css', 'spinkit.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo get_asset('css', 'datepicker.css'); ?>">
	<link rel="stylesheet" href="<?php echo get_asset('css', 'style.css'); ?>">
	<script>
		//Get anchor url
		var parts = location.href.split('#');
		if(parts.length > 1)
		{
		    var params = parts[0].split('?');
		    var mark = '?';
		    if(params.length > 1)
		    {
		        mark = '&';
		    }
		    location.href = parts[0] + mark + 'student=' + parts[1];
		}
	</script>
</head>
<body>