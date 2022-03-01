

## Notice 
- Require node 14 for dev
- Require php 8
- Base de donneés utilisé : Postgres
- Lancer le commande `composer install`
- Lancer le commande `npm install` (require for developpement only)
- Database : Dans le dossier \database\dump-caisse-202203011702.dump (ou vous pouvez aussi lancer le commande php artisan migrate pour avoir une nouvelle schema)
## Lancement du projet 
- Lance le commande `php artisan serve` 
- Login [localhost](http://127.0.0.1:8000)
- Lancer le commande `npm run dev` pour utiliser le webpack mix(require for developpement only)
- Default user : admin@caissemanagement.com
- Default password user : AdminFirst1@caisse
## Autre 
- Si vous rencotrer des problemes de session du lancement du proje,lancer le commande :
php artisan config:cache
