<!DOCTYPE html>
<html lang="fr" >
<head>
	<title>Moteur<?php if (defined('TITRE')) echo ' - '.TITRE ?></title>
	<meta charset="utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="<?php echo css('style.css') ?>" />
</head>
<body>
	<div>
		<a href="<?php echo url() ?>">Index</a><br />
		<a href="<?php echo url(null, 'test=azerty') ?>">Index (avec paramètre GET)</a><br />
		<a href="<?php echo url('test1') ?>">Test1</a><br />
		<a href="<?php echo url('test1', 'test=Coucou&amp;test2=salut') ?>">Test1 (avec paramètres GET)</a><br />
		<a href="<?php echo url('dossier/test2') ?>">Test2</a><br />
		<a href="<?php echo url('dossier/test2', 'test=Coucou&amp;test2=salut') ?>">Test2 (avec paramètres GET)</a><br />
		<a href="<?php echo url('test3/donnees/dynamiques') ?>">Test3 (URL dynamique)</a><br />
		<a href="<?php echo url('test3/donnees/dynamiqueslrebhirkg') ?>">Test3 (URL fausse)</a><br />
		<a href="<?php echo url('lol') ?>">Page inexistante</a><br />
	</div>
	<div>
		<?php require RACINE.'/'.DOSSIER_VUES.'/'.$page.'.php'; ?>
	</div>
</body>
</html>
