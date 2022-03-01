

## Notice 
- Require node 14 for dev
- Base de donne : Postgres
- Lancer le commande composer install
- Lancer le commande npm install
- Database : Dans le dossier \database\dump-caisse-202203011702.dump (ou vous pouvez aussi lancer le commande php artisan migrate pour avoir une nouvelle schema)
## Lancement du projet 
- php artisan serve
- Default user : admin@caissemanagement.com
- Default password user : AdminFirst1@caisse
## Autre 
- Si vous rencotrer des problemes de session du lancement du proje,lancer le commande :
php artisan config:cache
