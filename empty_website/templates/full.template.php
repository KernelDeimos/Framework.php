<?php ob_start();
/*
The output buffers (ob_start() etc...) used here are just a cheesy
way of optimizing page loading. Ideally, you'll want to have your
<head> element in a separate template, so you can send it do the
browser before heavy backend work like loading database contents.
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Untitled Framework Site</title>
	<?php
		$cssPath = "res/style/";
		$scriptPath = "res/script/";

		// Style
		HtmlShortcuts::includeCSS($cssPath.'full.css');
		// Script
		HtmlShortcuts::includeJS($scriptPath.'ajax_load.js');
	?>
</head>
<?php echo preg_replace('/\n+/', '', ob_get_clean()); flush(); ob_flush(); ob_start(); ?>
<body id="body">
	<?php
		$subTemplate->run();
	?>
</body>
</html>
<?php echo preg_replace('/\n+/', '', ob_get_clean()); ?>
