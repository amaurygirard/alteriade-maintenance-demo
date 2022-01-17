# À propos de ce projet

## Contexte
Ce projet a été développé pour le besoin de l'agence web [alteriade](https://alteriade.fr/) : gérer les contrats de maintenance courant pour les projets web de ses différents clients.

Le projet utilise entre autres les frameworks et librairies suivantes :
* [Laravel](https://laravel.com/) (6.20) pour le back-end,
* [Knacss](https://www.knacss.com/) (7.0) pour CSS (Sass),
* [jQuery](https://jquery.com/).

La version de démonstration est accessible ici : https://amaurygirard.alwaysdata.net/.
* Connexion en mode lecture :
  * ID : johnsmith@example.com
  * Mot de passe : johnsmith
* Connexion en mode lecture + écriture :
  * ID : johndoe@example.com
  * Mot de passe : johndoe

## Description
S'agissant d'un projet sur mesure, l'organisation interne de l'agence se retrouve dans les modèles de l'application.

### Clients, projets et contrats, interventions
Les données sont organisées pour l'essentiel à partir des clients. Un client peut avoir zéro, un ou plusieurs projets.

Un projet peut avoir zéro, un ou plusieurs contrats de maintenance, de type forfaitaire (nombre d'heures) ou calendaire (de date à date).

Chaque intervention effectuée dans le cadre du contrat de maintenance est ajoutée au contrat.

### Utilisateurs
Les utilisateurs sont répartis en trois équipes :
* équipe web, qui a l'accès en lecture et en écriture sur l'application,
* consultants et CEC (Chargés d'Étude et de Communication), qui ont l'accès en lecture uniquement.

Les consultants et CEC sont liés à chaque client et/ou projet qu'ils ont dans leur portefeuille. Un membre (ou plus) de l'équipe web est lié à une intervention.

## Évolutivité
Cet outil est pour l'instant pourvu de fonctionnalités assez basiques, mais il est appelé à évoluer, avec notamment :
* la configuration de l'envoi d'e-mails (qui rendra notamment possible la réinitialisation du mot de passe),
* l'envoi de notifications par e-mail lors du cycle de vie d'un contrat (création, intervention, expiration proche...),
* l'ajout d'observations sur les contrats pour faciliter la gestion collective.
* ajout de fonctionnalités additionnelles concernant les utilisateurs (suppression, modification, etc.)
