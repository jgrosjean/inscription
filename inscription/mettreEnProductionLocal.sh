php app/console cache:clear
php app/console cache:clear --env=prod
php app/console assets:install web
php app/console assetic:dump --env=prod
chmod -R 777 app/logs/*
chmod -R 777 app/cache/*
echo
echo ------------------------------------------
echo     production local OK         
echo ------------------------------------------
