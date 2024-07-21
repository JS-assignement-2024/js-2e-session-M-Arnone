# Documentation pour les développeurs

## Architecture du Code
L'application suit le modèle MVC (Model-View-Controller) pour une séparation claire des responsabilités.

### Arborescence du Projet
```plaintext
.
├── _api
│   └── api.php
├── _config
│   └── config.php
├── controllers
│   └── user.php
├── css
│   └── style.css
├── _db
│   ├── db.php
│   └── init.sql
├── images
│   ├── bg-login.jpg
│   ├── number.jpg
│   └── tableau-noir.jpg
├── _includes
│   └── navbar.php
├── index.html
├── js
│   ├── exercises.js
│   ├── logout.js
│   ├── scores.js
│   └── script.js
├── models
│   └── user.php
└── views
    ├── exercises.php
    └── scores.php
```
### Bonnes Pratiques de Développement

- _Désactiver le cache_ : Pour faciliter le développement et les tests.
- _Minimiser les interactions serveur_ : Pour améliorer les performances.
- _Sécurité_ : Ne jamais faire confiance aux données provenant du client.
- _Injection de dépendances par constructeur_ : Les objets sont détruits automatiquement lorsqu'ils ne sont plus nécessaires.

### Installation de Configuration
En utilisant WAMP.
- Cloner le dépôt.
- Déplacez le dossier `code` dans `wamp64/www/`
- Configurez la base de données en utilisant `_db/init.sql`
- Accédez au serveur en rentrant l'url `localhost/code/index.html`


### À propos
Pour toutes questions, contactez-moi via matteoarnone2001@gmail.com
