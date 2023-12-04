# Garage V. Parrot -- ECF

Ce site est un application Web vitrine pour un garage automobile fictif réalisée dans le cadre de mon ECF.
Lien vers le site : [Garage V.Parrot](https://ggeparrot-3f475c29d58b.herokuapp.com/)

## Deploiement en local

### Pré-requis

  - PHP 8.1 ou plus récent
  - Un SGBD (MySQL)
  - Serveur XAMPP ou similaire (A noter que XAMPP vous fourni le serveur, le SGBD et PHP 8.1)
  - Composer
  - Symfony CLI

### Instalation local

Afin d'utiliser le site en local vous devez suivre les étapes suivantes :
  1. Cloner le repository présent sur GitHub : https://github.com/Atsuyko/ggeparrot-ecf
    - git clone https://github.com/Atsuyko/ggeparrot-ecf,
  2. Ouvrir le dossier dans un IDE, ouvrir le terminal de commande, se placer dans le dossier du projet "cd ggeparrot-ecf" et taper "composer install",
  3. Modifier les paramètres de votre base de donnée le dossier ".env" (DATABASE_URL),
  4. Dans le terminal tapez :
    - php bin/console doctrine:database:create,
    - php bin/console doctrine:migration:migrate,
  5. Toujours le terminal tapez "symfony server:start".

Votre application est déployé en local, à ouvrir en cliquant sur le lien présent dans le terminal (lien "localhost" ou "127.0.0.1").

## Compte Admin

Vous avez deux options pour avoir accès aux administrateurs.

### Option 1 : Admin existant

En ayant effectuée l'étape 4 du déploiement en local, il vous suffit de vous connecter avec un compte administrateur présent en base de données.

### Option 2 : Créer un admin

Après avoir effectué l'étape 4 du déploiement en local :
  1. Se connecter avec un compte admin,
  2. Aller sur la page "Utilisateur" depuis la barre de navigation,
  3. Cliquer sur "Créer un patient",
  4. Remplir et soumettre le formulaire,
  5. Se rendre dans son SGBD sur la table "User" et ajouter à l'utilisateur créé le role (['ROLE-USER', 'ROLE_ADMIN']).

## Comptes présent en BDD depuis la migration 

Administrateur :
  - admin@admin.fr

  Employé :
  - employe@employe.fr

Le mot de passe pour l'ensemble des comptes est "password".