# Architecture MVC et API REST

## Objectif

Pour organiser correctement notre boutique en ligne,
nous avons choisi une architecture MVC avec une API REST.

Cette architecture permet de séparer le projet
en plusieurs parties afin de rendre le code plus
lisible et plus facile à maintenir.

## Model

Le Model gère les données de la base de données.

Il contient les requêtes SQL et les interactions
avec les tables comme :

- produits
- utilisateurs
- catégories
- commandes

## View

La View correspond à l'affichage du site.

Elle contient les pages visibles par l’utilisateur :

- accueil
- boutique
- panier
- dashboard

## Controller

Le Controller fait le lien entre le Model
et la View.

Il récupère les données du Model
et les envoie vers la View.

# API REST

Nous utiliserons également une API REST
afin de transmettre des données au format JSON.

Cette API sera utilisée avec JavaScript
et Fetch API afin de mettre à jour certaines
parties du site sans recharger la page.

## Exemples d'utilisation

L'API REST sera utilisée pour :

- la recherche dynamique
- les filtres produits
- l'autocomplétion
- certaines actions du dashboard admin

## JSON

Les données envoyées par l’API
seront au format JSON.

Exemple :

{
    "name": "PlayStation 5",
    "price": 499
}