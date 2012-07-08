<?php

/************************************************
			PARAMETRES
************************************************/

// URL de la racine web du site (sans slash final)
define('WWW', '/labs/moteur/site2');

// Adresse de la racine de l'application dans le système de fichier (sans slash final)
// Le fichier index.php que vous lisez en ce moment doit être dans ce dossier
//define('RACINE', '/home/david/Documents/labs/moteur'); 
$racine = explode('/', $_SERVER['SCRIPT_FILENAME']); unset($racine[count($racine)-1], $racine[count($racine)-1]); define('RACINE', implode('/', $racine)); // Pour le dev

// Adresse relative du répertoire contenant les vues (sans slash final)
define('DOSSIER_VUES', 'site2/pages');

// Adresse relative du répertoire contenant les feuilles de style (sans slash final)
define('DOSSIER_CSS', 'css');

// Adresse relative du répertoire contenant les feuilles de style optimisées (sans slash final)
// Mettre à false pour désactiver l'optimisation des feuilles de style
define('DOSSIER_CACHE_CSS', false);

// Adresse relative du répertoire contenant les scripts Javascript (sans slash final)
define('DOSSIER_JS', 'js');

// Adresse relative du répertoire contenant les scripts Javascript optimisés (sans slash final)
// Mettre à false pour désactiver l'optimisation des scripts Javascript
define('DOSSIER_CACHE_JS', false);

// Adresse relative du répertoire contenant le layout (sans slash final)
define('DOSSIER_LAYOUT', 'site2/layout');

// Adresse relative du répertoire contenant les actions (sans slash final)
define('DOSSIER_ACTIONS', 'actions');

// Nom du corps de la page par défaut (sans préciser l'extension .php, dans le répertoire des pages)
define('DEFAUT', 'index');

// Nom du layout (sans préciser l'extension .php)
define('LAYOUT', 'layout');

// Utiliser ou non l'url rewriting (true = oui)
// Attention : ne modifie que les liens internes ; vous devez paramétrer l'URL Rewriting vous même
define('REWRITING', true);

// Message à afficher si le layout est introuvable
define('ERREUR_LAYOUT', 'Le site est indisponible !');

// Page d'erreur 404, dans le dossier des vues (sans préciser l'extension .php)
define('ERREUR_404', '../../pages/404');

/*************************************************************************/

// Appel du moteur
require RACINE.'/lib/moteur/moteur.php';
