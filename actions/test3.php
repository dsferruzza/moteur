<?php

if ($params == '/donnees/dynamiques') $msg = 'C\'est ok !';
else
{
	header('HTTP/1.0 404 Not Found');
	$page = ERREUR_404;
}

?>