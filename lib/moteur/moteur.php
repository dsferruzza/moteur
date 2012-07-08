<?php
/*
    Copyright (c) 2011 David Sferruzza <david.sferruzza@gmail.com>
    
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/************************************************
			  FONCTIONS DE VUES
************************************************/

// Fonction qui renvoie l'url d'un lien interne
// Le 2ème paramètre peut contenir des paramètres GET (sans le point d'interrogation initial !) (ex : param1=val1&amp;param2=val2)
function url($page=null, $get=null)
{
	if ($page == DEFAUT) $page = null;
	if (REWRITING)
	{
		if (!empty($get)) $page .= '?'.$get;
	}
	else
	{
		if (!empty($get)) $page .= '&amp;'.$get;
		if (!empty($page)) $page = '?p='.$page;
	}
	return WWW.'/'.$page;
}

// Fonction qui renvoie l'url d'un fichier css optimisé
// Le fichier css est mis en cache après son optimisation, et le reste jusqu'à ce que l'original soit modifié
function css($css, $minify=true)
{
	if (!file_exists(RACINE.'/'.DOSSIER_CSS.'/'.$css)) return false;
	elseif (DOSSIER_CACHE_CSS != false and $minify)
	{
		if (!file_exists(RACINE.'/'.DOSSIER_CSS.'/cache/'.$css) or filemtime(RACINE.'/'.DOSSIER_CSS.'/'.$css) > filemtime(RACINE.'/'.DOSSIER_CSS.'/cache/'.$css))
		{
			$handle = fopen(RACINE.'/'.DOSSIER_CSS.'/'.$css, 'r');
			$fichier = fread($handle, filesize(RACINE.'/'.DOSSIER_CSS.'/'.$css));
			fclose($handle);
			
			include_once RACINE.'/lib/cssmin/cssmin.php';
			$fichier = CssMin::minify($fichier);
	
			$handle = fopen(RACINE.'/'.DOSSIER_CSS.'/cache/'.$css, 'w+');
			fwrite($handle, $fichier);
			fclose($handle);
		}
		return WWW.'/'.DOSSIER_CACHE_CSS.'/'.$css;
	}
	else return WWW.'/'.DOSSIER_CSS.'/'.$css;
}

// Fonction qui renvoie l'url d'un fichier js optimisé
// Le fichier js est mis en cache après son optimisation, et le reste jusqu'à ce que l'original soit modifié
// Le paramètre $minify permet d'empêcher l'optimisation (sur des bibliothèques déjà optimisées, par exemple)
function js($js, $minify=true)
{
	if (!file_exists(RACINE.'/'.DOSSIER_JS.'/'.$js)) return false;
	elseif (DOSSIER_CACHE_JS != false and $minify)
	{
		if (!file_exists(RACINE.'/'.DOSSIER_JS.'/cache/'.$js) or filemtime(RACINE.'/'.DOSSIER_JS.'/'.$js) > filemtime(RACINE.'/'.DOSSIER_JS.'/cache/'.$js))
		{
			$handle = fopen(RACINE.'/'.DOSSIER_JS.'/'.$js, 'r');
			$fichier = fread($handle, filesize(RACINE.'/'.DOSSIER_JS.'/'.$js));
			fclose($handle);
			
			include_once RACINE.'/lib/jsmin-php/jsmin.php';
			$fichier = JSMin::minify($fichier);
	
			$handle = fopen(RACINE.'/'.DOSSIER_JS.'/cache/'.$js, 'w+');
			fwrite($handle, $fichier);
			fclose($handle);
		}
		return WWW.'/'.DOSSIER_CACHE_JS.'/'.$js;
	}
	else return WWW.'/'.DOSSIER_JS.'/'.$js;
}

/*************************************************************************/

/*
	1) Détermination de la page demandée (remplissage de la variable $page)
	2) Inclusion de l'action qui porte le même nom que la page, si elle existe
	3) Affichage du layout (lequel incluera le contenu de la page $page)
		sauf si la constante NO_LAYOUT existe (dans quel cas on charge la page et pas le layout)
*/

// Sélection de la page
if (!empty($_GET['p']))
{
	// On épure un peu le paramètre d'entrée
	$url = trim($_GET['p']);
	//$url = trim(strtolower($_GET['p'])); // Utiliser cette ligne à la place de la précédente permet d'ignorer la casse
	
	// On sépare page et paramètres (pour les URLs dynamiques))
	$url = explode('/', $url);
	$n = 0;
	$t = count($url);
	if (empty($url[$t-1]))
	{
		unset($url[$t-1]);
		$t --;
	}
	$page = $url[0];
	$params = null;
	while ($n < $t-1)
	{
		$n ++;
		if (is_dir(RACINE.'/'.DOSSIER_VUES.'/'.$page.'/'.$url[$n])) $page .= '/'.$url[$n];
		else
		{
			if (is_file(RACINE.'/'.DOSSIER_VUES.'/'.$page.'/'.$url[$n].'.php')) $page .= '/'.$url[$n];
			else $params .= '/'.$url[$n];
		}
	}
	unset ($n, $t, $url);
	
	// Si la page n'existe pas
	if (!is_file(RACINE.'/'.DOSSIER_VUES.'/'.$page.'.php'))
	{
		// On déclenche une erreur 404 et on affiche la page correspondante
		header('HTTP/1.0 404 Not Found');
		define('E404_page', $page);
		define('E404_referer', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '?');
		$page = ERREUR_404;
	}
}
else $page = DEFAUT;

// Chargement de l'action, si elle existe
define('ACTION', RACINE.'/'.DOSSIER_ACTIONS.'/'.$page.'.php');
if (is_file(ACTION)) require ACTION;

// Affichage du layout, sauf si on l'a désactivé
if (defined('NO_LAYOUT')) require RACINE.'/'.DOSSIER_VUES.'/'.$page.'.php';
else
{
	// On vérifie que le layout est présent
	if (!is_file(RACINE.'/'.DOSSIER_LAYOUT.'/'.LAYOUT.'.php')) die(ERREUR_LAYOUT);
	
	require RACINE.'/'.DOSSIER_LAYOUT.'/'.LAYOUT.'.php';
}
