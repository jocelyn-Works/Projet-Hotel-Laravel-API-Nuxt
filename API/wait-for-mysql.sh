#!/bin/sh

echo "⏳ Attente que MySQL soit disponible sur $DB_HOST:$DB_PORT..."

# Boucle jusqu'à ce que le port 3306 du conteneur MySQL soit ouvert
until nc -z -v -w30 "$DB_HOST" "$DB_PORT"; do
  echo "⛔ MySQL pas encore prêt sur $DB_HOST:$DB_PORT..."
  sleep 2
done

echo "✅ MySQL est prêt ! Lancement des migrations + seed..."
php artisan config:clear
php artisan migrate --seed

echo "🚀 Lancement du serveur Laravel"
php artisan serve --host=0.0.0.0 --port=8000
