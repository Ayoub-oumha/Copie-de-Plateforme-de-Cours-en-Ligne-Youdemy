# Plateforme de Cours en Ligne - Youdemy

## Description
**Youdemy** est une plateforme interactive et personnalisée dédiée à l’apprentissage en ligne. Elle permet aux étudiants d’accéder à des cours variés et aux enseignants de gérer leurs contenus pédagogiques efficacement. Le projet repose sur les concepts de programmation orientée objet (OOP) en PHP natif, assurant une architecture modulaire, claire et extensible.

## Technologies Utilisées
- **HTML5** : Structure des pages web.
- **CSS3** : Styles et mise en page responsive.
- **JavaScript** : Interactivité et validation côté client.
- **PHP** : Backend avec principes OOP (encapsulation, héritage, polymorphisme).
- **MySQL** : Gestion des données relationnelles.
- **UML** : Modélisation et conception.

## Fonctionnalités
### Front Office
#### Visiteur
- Accès au catalogue des cours avec pagination.
- Recherche de cours par mots-clés.
- Création de compte (Étudiant ou Enseignant).

#### Étudiant
- Visualisation et recherche de cours.
- Consultation des détails des cours.
- Inscription aux cours après authentification.
- Accès à une section “Mes cours”.

#### Enseignant
- Ajout de nouveaux cours avec :
  - Titre, description, contenu (vidéo ou document), tags et catégories.
- Gestion des cours (modification, suppression, suivi des inscriptions).
- Accès aux statistiques des cours (inscriptions, popularité, etc.).

### Back Office
#### Administrateur
- Validation des comptes enseignants.
- Gestion des utilisateurs (activation, suspension, suppression).
- Gestion des contenus (cours, catégories, tags).
- Statistiques globales :
  - Nombre total de cours.
  - Répartition des cours par catégories.
  - Cours le plus populaire.
  - Top 3 des enseignants.

### Fonctionnalités Transversales
- Relation many-to-many entre les cours et les tags.
- Polymorphisme dans les méthodes `AjouterCours` et `AfficherCours`.
- Système d’authentification et d’autorisation.
- Contrôle d’accès basé sur les rôles.


## Diagrammes UML
- Diagramme des cas d'utilisation.
- Diagramme de classes.

## Modalités Pédagogiques
- **Durée** : 5 jours.
- **Date de début** : 13/01/2025.
- **Date limite** : 20/01/2025 à 17h30.


## Critères de Performance
- Séparation claire entre la logique métier et l’architecture.
- Utilisation cohérente des concepts OOP.
- Validation côté client et serveur.
- Pages web responsive.
- Sécurité renforcée contre les attaques.

