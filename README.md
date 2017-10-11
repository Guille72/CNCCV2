# CNCCV2

##Composer en ligne de commande
###Acquérir Composer :
https://getcomposer.org/
* Composer va permettre de récupérer des bibliothèques externes au projet afin d'ajouter des fonctionnalités.
* Exemples : PHPMailer, Xajax, FPDF...

###Installer Composer localement (uniquement sur le projet) =/= globalement:
* `$ composer ` ou `$ php composer.phar `

###Débuter un projet :
* `$ composer init` ou `$ php composer.phar init`

###Installer des composants :
* `$ composer install LeNomDeLaLibrairie` ou `$ php composer.phar install LeNomDeLaLibrairie`

###Mettre à jour les composants installés :
* `$ composer update` ou `$ php composer.phar update`

##NPM
###Acquérir NPM avec NodeJS :
* NPM permet également d'installer des applications Node.js disponibles sur le dépôt npm. Il s'agit donc d'un
gestionnaire pour des dépendances en JavaScript.

https://www.npmjs.com

* NodeJS Node.js contient une bibliothèque de serveur HTTP intégrée, ce qui rend possible de faire tourner un serveur 
web sans avoir besoin d'un logiciel externe sur notre site. En clair, les éléments installés par NPM fonctionnent grâce
à NodeJS.

https://nodejs.org/en/

###Installation de NPM et NodeJS :
* Pour installer NPM, il faut obligatoirement installer NodeJS.
* Pour installer NodeJS, il faut aller sur le site internet et prendre le fichier .exe

###Installer des dépendances (jquery, magnific-popup, webpack...):
* Sur Github ou le site des frameworks (par exemple) il est écrit une ligne de commande.
* Exemple :   `$ npm install materialize-css --save-dev|--save`
   
    * `--save-dev` : Une dépendance de développement.
    * `--save` : Une dépendance.

###Commandes NPM :
* `$ npm install`<br/>
    Installe les dépendances du projet.
    

* `$ npm update` <br/>
Pour mettre à jour les dépendances du projet.

* `$ npm run watch` <br/>
Pour compiler les dépendances tout en développant.

* `$ npm run build`<br/>
Pour minimiser tous les fichiers à la fin du projet avant la mise en production.

* `$ npm run debug`<br/>
Créer des fichiers source-map en cas de débuggage.

##Pour ajouter des dépendances :

* Du type JavaScript : 
    * Pour ajouter notre propre JavaScript, il faut l'insérer dans le fichier main.js, dans le dossier assets puis le
    dossier js : `app/Resource/assets/js/main.js`
    
    * Dans ces mêmes dossiers, le JS des dépendances installées se situe dans le fichier app.js : `assets/js/app.js` (Ne pas y toucher)

* Du type CSS/SCSS :
    * Pour ajouter notre propre CSS/SCSS, il faut l'insérer dans le fichier style.scss, dans le dossier assets puis le
    dossier scss : `app/Resource/assets/scss/style.scss`
    
    * Dans ces mêmes dossiers, le CSS/SCSS des dépendances installées se situe dans le fichier app.scss : `assets/scss/app.scss` (Ne pas y toucher)

##Framework PHP : Symfony

* Lancer le seveur :
    * `php bin/console server:run`

* Lancer WebPack :
    * `yarn run encore dev --watch`

* Adresse du site une fois le serveur lancé :
    * `http://127.0.0.1:8000/`

* Vider le cache :
    * `php bin/console cache:clear --env=dev`

* Mettre à jour les tables :
    * `php bin/console doctrine:schema:update --force`

* Mettre les Modèles dans :
    * src -> Nom du projet -> Le Bundle qui va réunir le tout -> Entity -> Fichier au singulier

* Mettre les vues dans :
    * src -> Nom du projet -> Le Bundle qui va réunir le tout -> Resources -> views

* Mettre les Controleurs dans :
    * src -> Nom du projet -> Le Bundle qui va réunir le tout -> Controller -> NomController