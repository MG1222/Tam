# Tamagotchi
## E-commerce de [Tamagotchi](https://margadgantuya.sites.3wa.io/project/index.php/)

## Introduction

Ce projet est une plateforme e-commerce développée en PHP. Elle inclut les opérations CRUD (Créer, Lire, Mettre à jour, Supprimer) de base et intègre Stripe pour le traitement des paiements. L'application permet aux utilisateurs de parcourir les produits, de les ajouter au panier et de faire des achats. De plus, elle possède un panneau d'administration pour la gestion des produits et des commandes.

## Fonctionnalités

- Enregistrement et authentification des utilisateurs
- Liste des produits
- Vue détaillée des produits
- Panier d'achat
- Passation de commandes
- Traitement des paiements via Stripe
- Panneau d'administration pour la gestion des produits et des commandes

## Installation

### Prérequis

- PHP 7.4 ou supérieur
- MySQL
- Composer
- Clés API Stripe

### Étapes

1. **Cloner le dépôt**

   ```bash
   git clone https://github.com/MG1222/Tam
   cd Tam
   ```

2. **Installer les dépendances**

   Utilisez Composer pour installer les dépendances PHP requises.

   ```bash
   composer install
   ```

3. **Configurer la base de données**

   Créez une base de données MySQL et importez le fichier SQL fourni pour configurer les tables nécessaires.

   ```sql
   CREATE DATABASE ecommerce;
   USE ecommerce;
   SOURCE chemin/vers/ecommerce.sql;
   ```

4. **Configurer les variables d'environnement**

   Renommez le fichier `database.php`, `stripe` en `config` et mettez à jour les paramètres de configuration de la base de données et de Stripe .

   ```plaintext
   DB_HOST=localhost
   DB_NAME=ecommerce
   DB_USER=root
   DB_PASS=motdepasse
   ```
    ```plaintext
   STRIPE_PUBLIC_KEY=cle_publique_stripe
   STRIPE_SECRET_KEY=cle_secrete_stripe
   ```

5. **Lancer l'application**

   Démarrez votre serveur local (par exemple, en utilisant XAMPP ou MAMP) et accédez au répertoire du projet dans votre navigateur.

   ```bash
   http://localhost/Tam
   ```

## Utilisation

### Comptes Utilisateurs

- **Compte Utilisateur Test**
  - Email: test@gmail.com
  - Mot de passe: testtest

- **Compte Administrateur**
  - Email: admin@gmail.com
  - Mot de passe: adminadmin

### Aperçu des Fonctionnalités

- **Enregistrement et Connexion**: Les utilisateurs peuvent s'enregistrer et se connecter à leur compte pour gérer leurs commandes et leur profil.
- **Liste des Produits**: Parcourez une liste de produits disponibles.
- **Détails du Produit**: Consultez des informations détaillées sur un produit.
- **Panier d'Achat**: Ajoutez des produits au panier et procédez au paiement.
- **Passation de Commandes**: Passez des commandes et traitez les paiements via Stripe.
- **Panneau d'Administration**: Les administrateurs peuvent gérer les produits et les commandes depuis le panneau d'administration.



## Panneau d'Administration

Le panneau d'administration permet aux administrateurs de gérer les listes de produits et les commandes. Les administrateurs peuvent ajouter, modifier et supprimer des produits, ainsi que consulter et mettre à jour le statut des commandes.

### Accéder au Panneau d'Administration

- **Compte Administrateur**
  - Email: admin@gmail.com
  - Mot de passe: adminadmin


## Intégration des Paiements

Cette application utilise Stripe pour le traitement des paiements. Assurez-vous d'avoir configuré vos clés API Stripe dans le fichier `.env`.

### Tester les Paiements

- Payer via stripe (https://docs.stripe.com/testing?locale=fr-FR)
    : Tests interactifs
      Lorsque vous effectuez des tests interactifs, utilisez un numéro de carte bancaire tel que 4242 4242 4242 4242. Saisissez ce numéro de carte dans       un formulaire de paiement.
      
      Utilisez une date d’expiration valide telle que 12/34.
      Utilisez n’importe quel code CVC à trois chiffres (quatre chiffres pour les cartes American Express).
      Utilisez la valeur de votre choix pour les autres champs du formulaire.




