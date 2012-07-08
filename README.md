# Moteur

Mon framework léger personnel.

Développé par et pour moi, dans le but de gagner du temps sur la création de petits sites web.

## Fonctionnalités

* Organisation de l'espace travail (pseudo MVC)
* Système simple de routage des URLs
* Système de [layout](http://www.symfony-project.org/images/jobeet/1_4/04/layout.png)
* URLs "jolies" (utilise la réécriture d'URL)
* URLs dynamiques (ex : l'URL `/mapage/monparamètre` va affiche la page `mapage` en lui passant le paramètre `monparamètre` ; c'est à la page en question de définir les actions à faire en fonction du paramètre)
* Compression automatique des fichiers CSS et JS
* Possibilité de faire fonctionner plusieurs sites indépendants à partir du même noyau
* Faible impact du framework sur les performances

## Prérequis

* Un serveur web (des fichiers .htaccess sont fournis avec le projet ; pas de configuration à faire donc pour Apache2)
* PHP5+

## Installation

* Copier les fichiers dans un dossier accessible par le serveur web.
* Régler les paramètres dans le fichier index.php
* Ajouter le contenu !

## Fonctionnement

Il n'y a qu'un seul point d'entrée : le fichier `index.php`.
Celui-ci appelle le moteur, qui réalisera les actions suivantes :

### Détermination de la page demandée

Le moteur récupère le paramètre (par défaut : `p`) passé dans l'URL et cherche une correspondance dans le dossier page.

Exemple : l'URL `/index.php?p=page` (ou `/page`) va chercher le fichier `pages/page.php`.

Si la page n'existe pas, la page d'erreur 404 est sélectionnée à la place.

### Exécution de l'action correspondante

S'il existe un fichier dans le dossier `actions` pourtant le même nom que la page, celui-ci est exécuté.

### Affichage du layout

Le fichier `layout/layout.php` est exécuté.

Il doit contenir la ligne suivante, qui sera remplacée par le contenu de la page :

```php
<?php require RACINE.'/'.DOSSIER_VUES.'/'.$page.'.php'; ?>
```

## Fonctionnement multi-site

Il est possible de faire fonctionner plusieurs site distincts sur le même noyau !

Dans la configuration d'exemple, le dossier `site2` contient son propre point d'entrée, qui défini des paramètres de fonctionnement (dossiers des pages, des actions, ...) différents de ceux du site principal.

On peut donc propulser plusieurs site avec le même moteur !

## API

En plus des paramètres documentés dans `index.php`, le moteur propose quelques méthodes et paramètres pouvant être utilisés depuis le layout, les actions et les pages.

### Variables/constantes

**$page**

Contient le nom de la page qui sera affichée. Peut être modifié dans un fichier action, ou utilisé dans une page qui a besoin de son propre nom, par exemple.


**$params**

Contient les paramètres passés à la page dans le cas d'une URL dynamique.

Exemple : avec une seule page `mapage`, l'URL `/index.php?p=mapage/42` (ou `/mapage/42`) donnera `$page = 'mapage'` et `$params = '/42'`.


**E404_page**

Lorsqu'on appelle une page inexistante, cette constante existe et contient le nom de la page demandée.


**E404_referer**

Lorsqu'on appelle une page inexistante, cette constante existe et contient le nom de la page sur laquelle on était avant de déclencher l'erreur 404 (si elle existe).


**NO_LAYOUT**

Si cette constante est créée dans une action, le layout n'est pas affiché ; celle la page demandée l'est.

### Méthodes

**url($page, $get)**

Renvoie l'adresse d'une page interne.

`$page` (défaut : null) : nom de la page.

`$get` (défaut : null) : paramètres GET sans point d'interrogation initial (exemple : `param1=val1&amp;param2=val2`)


**css($css, $minify)**

(Compresse)/Renvoie l'adresse d'un fichier CSS.

`$css` : nom du fichier (avec extension)

`$minify` (défaut : true) : indique s'il faut compresser le fichier CSS (true) ou pas (false) avant de retourner son adresse. Les fichiers compressés sont créés automatiquement dans un dossier dédié lorsque l'original est modifié.

La bibliothèque [CssMin](http://code.google.com/p/cssmin/) est utilisée pour la compression.


**js($js, $minify)**

(Compresse)/Renvoie l'adresse d'un fichier JS.

`$js` : nom du fichier (avec extension)

`$minify` (défaut : true) : indique s'il faut compresser le fichier JS (true) ou pas (false) avant de retourner son adresse. Les fichiers compressés sont créés automatiquement dans un dossier dédié lorsque l'original est modifié. Il est conseillé de ne pas compresser les fichiers qui le sont déjà.

La bibliothèque [jsmin-php][jsmin-php] est utilisée pour la compression.

## Contribution

Je suis ouvert à tout avis, question, suggestion !

## Licence

GNU LGPL v3 [https://www.gnu.org/licenses/lgpl.html](https://www.gnu.org/licenses/lgpl.html)
