Documentation for auth user  with symfony(login):


https://smoqadam.me/posts/how-to-authenticate-user-in-symfony-5-by-jwt/

#   NEW PROYECT
composer create-project symfony/skeleton:"6.3.*" my_project_directory
cd my_project_directory
composer require webapp
composer require --dev symfony/maker-bundle
composer require symfony/orm-pack




# CREATE DATABASES:

Si es necesario cuando no encuentra en driver
sudo apt install php7.3-mysql

php bin/console doctrine:database:create


# CREATE TABLES:


php bin/console doctrine:schema:create
php bin/console doctrine:schema:update --force

INSTALL SYMFONY CLI:

curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
T

CREATE TABLE:
php bin/console make:entity 'nombre'



composer require --dev symfony/maker-bundle
composer require symfony/orm-pack
composer require symfony/twig-bundle
composer require symfony/ux-vue
npm install -D vue-loader --force
npm run watch

*** or with yarn ***

yarn add vue-loader --dev --force
yarn watch

init proyect:

symfony server:start

