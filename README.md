
git clone the repo

run composer update

run these commands in the repo folder

php app/console doctrine:dababase:create --env=test
php app/console doctrine:dababase:create --env=prod

php app/console doctrine:schema:update --force --env=test
php app/console doctrine:schema:update --force --env=prod

php app/console doctrine:fixtures:load --env=test
php app/console doctrine:fixtures:load --env=prod

RUN the phpunit test:
php vendor/phpunit/phpunit/phpunit -c ./app/



