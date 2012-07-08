<!DOCTYPE html>
<html lang="fr" >
<head>
	<title>Moteur<?php if (defined('TITRE')) echo ' - '.TITRE ?></title>
	<meta charset="utf-8" />
</head>
<body>
	<div>
		<p>Bienvenue sur le site 2 !</p>
		<p><a href="../">Retour au site principal</a></p>
	</div>
	<div>
		<?php require RACINE.'/'.DOSSIER_VUES.'/'.$page.'.php'; ?>
	</div>
</body>
</html>
