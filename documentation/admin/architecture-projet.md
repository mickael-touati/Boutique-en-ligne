# Architecture du projet

## Objectif

Le projet sera organisé avec une architecture MVC
afin de séparer les différentes responsabilités
de l’application.

Cette organisation permettra de rendre
le code plus lisible et plus facile à maintenir.

## Structure des dossiers

boutique-en-ligne/

│

├── app/

│   ├── controllers/

│   ├── models/

│   ├── views/

│

├── public/

│   ├── assets/

│   │   ├── css/

│   │   ├── js/

│   │   ├── images/

│

├── admin/

│

├── api/

│

├── config/

│

├── database/

│

├── documentation/

│

├── index.php

## API REST

Le dossier API permettra d’envoyer
des données JSON au JavaScript
afin de créer des fonctionnalités asynchrones.

Exemples :

- recherche dynamique
- filtres produits
- connexion utilisateur
- dashboard admin

## JavaScript

Le JavaScript sera utilisé pour :

- Fetch API
- recherche dynamique
- filtres AJAX
- interactions utilisateur
- mise à jour dynamique du dashboard

