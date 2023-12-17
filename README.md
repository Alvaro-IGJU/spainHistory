Documentation for auth user  with symfony(login):



#   NEW PROYECT
composer create-project symfony/skeleton:"6.3.*" my_project_directory
cd my_project_directory
composer require webapp
composer require --dev symfony/maker-bundle
composer require symfony/orm-pack
composer require symfony/security-bundle

https://symfony.com/bundles/LexikJWTAuthenticationBundle/current/4-cors-requests.html
composer require nelmio/cors-bundle



# CREATE DATABASES:

Si es necesario cuando no encuentra en driver
sudo apt install php7.3-mysql

php bin/console doctrine:database:create


# CREATE TABLES:

php bin/console cache:clear
php bin/console doctrine:schema:create
php bin/console doctrine:schema:update --force

INSTALL SYMFONY CLI:
 https://symfony.com/download
curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
sudo apt install symfony-cli


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

-------------------------------------------
CHANGE VERSION PHP

* sudo update-alternatives --config php
------------------------------------------



Opciones de crear entidades dentro de la estructuta sin aplicar maker-bundler 

1. 

php bin/console make:entity '\App\Test\Person\Domain\Person'

2. Ver ejemplo en fichero packages\dev\twc_maker.yaml:

composer require twc/maker-bundle --dev