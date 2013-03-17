<!DOCTYPE html>
<html lang="fr" >
<head>
	<title>Moteur<?php if (defined('TITRE')) echo ' - '.TITRE ?></title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="<?php echo css('style.css') ?>" />
</head>
<body>
	<div>
		<p><em>Ceci est un petit site d'exemple réalisé à la va-vite pour montrer et tester les fonctionnalités de mon moteur.<br />
		Pour bien comprendre le fonctionnement dudit moteur, il est conseillé de lire le fichier README et de regarder le code source des pages, actions et layouts qui me servent ici d'exemple.</em></p>
		<h1>Menu</h1>
		<a href="<?php echo url() ?>">Index</a><br />
		<a href="<?php echo url(null, 'test=azerty') ?>">Index (avec paramètre GET)</a><br />
		<a href="<?php echo url('test1') ?>">Test1</a><br />
		<a href="<?php echo url('test1', 'test=Coucou&amp;test2=salut') ?>">Test1 (avec paramètres GET)</a><br />
		<a href="<?php echo url('dossier/test2') ?>">Test2</a><br />
		<a href="<?php echo url('dossier/test2', 'test=Coucou&amp;test2=salut') ?>">Test2 (avec paramètres GET)</a><br />
		<a href="<?php echo url('test3/donnees/dynamiques') ?>">Test3 (URL dynamique)</a><br />
		<a href="<?php echo url('test3/donnees/dynamiqueslrebhirkg') ?>">Test3 (URL dynamique fausse)</a><br />
		<a href="<?php echo url('test4') ?>">Test4 (pas de page)</a><br />
		<a href="<?php echo url('lol') ?>">Page inexistante</a><br />
		<a href="site2/">Un 2ème site propulsé par le même moteur</a><br />
	</div>
	<div>
		<?php if (is_file(RACINE.'/'.DOSSIER_VUES.'/'.$page.'.php')) require RACINE.'/'.DOSSIER_VUES.'/'.$page.'.php'; ?>
	</div>
</body>
</html>
