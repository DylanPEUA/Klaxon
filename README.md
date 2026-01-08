# Klaxon 🚗

Application intranet de covoiturage permettant aux employés d'une entreprise multi-sites de partager leurs trajets.

## 📋 Prérequis

- PHP 7.4 ou supérieur
- MySQL / MariaDB
- Composer
- Serveur web (Apache, Nginx) ou serveur PHP intégré

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone <url-du-repo>
cd Klaxon
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer la base de données

1. Créer une base de données MySQL :

```sql
CREATE DATABASE klaxon CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Modifier le fichier `config/database.php` avec vos identifiants :

```php
return [
    'host'     => 'localhost',
    'dbname'   => 'klaxon',
    'user'     => 'votre_utilisateur',
    'password' => 'votre_mot_de_passe',
];
```

3. Importer le schéma et les données de test :

```bash
mysql -u votre_utilisateur -p klaxon < database/schema.sql
mysql -u votre_utilisateur -p klaxon < database/seed.sql
```

### 4. Lancer le serveur

```bash
php -S localhost:8000 -t public
```

L'application est accessible sur [http://localhost:8000](http://localhost:8000)

## 👤 Comptes de test

| Rôle  | Email                        | Mot de passe |
|-------|------------------------------|--------------|
| Admin | admin@email.fr               | password     |
| User  | alexandre.martin@email.fr    | password     |

## 🧪 Tests

### Lancer les tests unitaires

```bash
vendor/bin/phpunit
```

### Analyse statique (PHPStan)

```bash
vendor/bin/phpstan analyse
```

## 📁 Structure du projet

```
Klaxon/
├── app/
│   ├── Controllers/    # Contrôleurs MVC
│   ├── Database/       # Connexion PDO
│   ├── Models/         # Entités métier
│   ├── Repositories/   # Accès aux données
│   ├── Services/       # Logique métier
│   └── Views/          # Templates PHP
├── config/             # Configuration (BDD, bootstrap)
├── database/           # Scripts SQL (schema, seed)
├── public/             # Point d'entrée (index.php, assets)
├── tests/              # Tests PHPUnit
└── vendor/             # Dépendances Composer
```

## ⚙️ Fonctionnalités

### Utilisateur connecté
- Consulter la liste des trajets disponibles
- Créer un nouveau trajet
- Modifier/Supprimer ses propres trajets

### Administrateur
- Toutes les fonctionnalités utilisateur
- Gestion des agences (CRUD)
- Liste des employés
- Gestion de tous les trajets

## 🎨 Palette de couleurs

| Couleur   | Code      | Usage          |
|-----------|-----------|----------------|
| Light     | `#f1f8fc` | Fond           |
| Primary   | `#0074c7` | Actions        |
| Secondary | `#00497c` | Navbar, footer |
| Dark      | `#384050` | Texte          |
| Danger    | `#cd2c2e` | Suppression    |
| Success   | `#82b864` | Confirmation   |

## 📝 Licence

Projet réalisé dans le cadre d'une formation.
