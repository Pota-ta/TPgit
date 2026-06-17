2025-07-07

22-tp-real-data-v4.md

## TP sur des données réèlles

## Objectifs

Installer les données Créer des pages

## Etapes

- -. Télécharger les données ici https://github.com/datacharmer/test_db (download zip) Le fichier fait 35Mo. Utiliser localsend pour donner aux autres étudiants.
- /. Lire le fichier Readme pour installer.

0. Voir l'image pour voir la structure de la base (images/employees.png).

## Notes techniques

- -. Respecter le rangement des répértoires
- /. Utiliser Git en binôme

0. Utiliser Bootstrap

## Code

## Version 1

- -. Créer une page qui affiche la liste des départements
- /. Rajouter une colonne qui affiche le nom du manager en cours

0. Mettre un lien sur chaque ligne de département pour afficher dans une autre page la liste des employés de ce département.

## Version 2

- -. Lorsqu'on clique sur un employé, on doit afficher la fiche de l'employé
- /. Rajouter l'historique du salaire et de l'emploi occupe dans la fiche,

0.     Créer un formulaire de recherche ( departement, nom employé, age min et max )
1. Afficher seulement 20 lignes (utiliser LIMIT en SQL )

```
SELECT * FROM etudiants
LIMIT20, 10;
-- saute les 20 premiers et affiche les 10 suivants
```

3. Créer un lien suivant pour afficher les 20 prochaines lignes
4. Créer un lien précédent pour afficher les 20 lignes précédentes

## Version 3

- -. Ajouter une colonne nombre employé sur la liste des départements

1 / 2

2025-07-07

22-tp-real-data-v4.md

- /. Créer une page pour afficher un tableau contenant le nombre d'employé (homme et femme ), et le salaire moyen pour chaque emploi

0. Dans la fiche employé, mettre l'emploi le plus long (en terme de date)

## Version 4

- -. Dans la fiche de l'employé, mettre un bouton "changer de département". Cela va ouvrir un formulaire (choix département, date de début).

  - a. Vérifier que le nouveau département s'affiche bien après l'ajout
  - b. Mettre en haut du formulaire le département actuel avec la date de début( dans la zone de liste, ne pas mettre le département actuel )
  - c. Mettre un message de d'erreur si la date de début du nouveau département est antérieur à la date du début de l'actuel'
- /. Dans la fiche de l'employé, mettre un bouton "Devenir Manager". Cela va ouvrir un formulaire (Date de début).

  - a. Vérifier dans la liste des départements qu'il est bien le nouveau manager
  - b. Mettre en haut du formulaire le nom du manager en cours.
  - c. Mettre un message de d'erreur si la date de début du nouveau manager est antérieur à la date du
  - début de l'actuel

2 / 2
