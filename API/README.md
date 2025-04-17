## ⚙️ Installation du projet

### 📦 Installer les dépendances PHP
```bash
composer install
```

---

### 📄 Configuration du fichier `.env`

Copier et coller ce contenu dans un fichier `.env` à la racine du dossier `/API` :

```dotenv
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000/

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database
PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Hotel
DB_USERNAME= // Remplir
DB_PASSWORD= // Remplir

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

---

## 🚀 Lancer le projet

```bash
php artisan key:generate
```

Remplir dans `.env` :
- `DB_USERNAME=`
- `DB_PASSWORD=`

### 🛠️ Migration pour la base de données

```bash
php artisan migrate
```

### 🔁 Rafraîchir la base

```bash
php artisan migrate:refresh
```

### 🧪 Recréer la base avec données de test

```bash
php artisan migrate:fresh --seed
```

### 🌍 Démarrer le serveur Laravel

```bash
php artisan serve
```

---

## 📚 Documentation API avec Swagger

### ✅ Étapes d'installation sur ton poste

1. Installe L5 Swagger (si pas déjà fait) :
```bash
composer require "darkaonline/l5-swagger"
```

2. Génère la documentation :
```bash
php artisan l5-swagger:generate
```

3. Accède à la documentation dans ton navigateur :
```
http://localhost:8000/api/documentation
```

💡 Astuce : si la documentation n’apparaît pas, vérifie que les annotations `@OA` sont bien présentes dans les controllers.

---

## 📆 Exemple de vérification de disponibilité

> Dans Postman, envoyer une requête **POST** vers :

```
http://localhost:8000/api/check-availability
```

Avec un body :
```json
{
  "dateDebut": "2025-03-25",
  "dateFin": "2025-03-28"
}
```
