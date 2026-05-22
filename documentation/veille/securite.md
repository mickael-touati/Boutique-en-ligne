# Sécurité de l'application

## Objectif

La sécurité est une partie importante de notre boutique en ligne.

Nous devons protéger :

- les utilisateurs
- les données
- les formulaires
- la base de données
- l’espace administrateur

## Protection contre les injections SQL

Nous utiliserons PDO et les requêtes préparées
afin de sécuriser les requêtes SQL.

Cela permet d’éviter les injections SQL
dans les formulaires.

## Hachage des mots de passe

Les mots de passe des utilisateurs
seront protégés avec bcrypt grâce
à password_hash() de PHP.

Cela permet de sécuriser les comptes utilisateurs
en cas de fuite de données.

## Protection contre les failles XSS

Les données affichées sur le site
seront sécurisées avec htmlspecialchars().

Cela permet d’éviter l’injection
de scripts JavaScript malveillants.

## Validation des formulaires

Les formulaires seront vérifiés
côté JavaScript et côté PHP.

Les champs obligatoires devront être remplis
correctement avant l’envoi des données.

## Sécurisation du dashboard administrateur

Le dashboard administrateur sera protégé
avec un système de session utilisateur.

Seuls les administrateurs pourront accéder
aux pages d’administration.