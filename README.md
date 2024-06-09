

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

php bin/console doctrine:database:create




# CREATE TABLES:


php bin/console doctrine:schema:create
php bin/console doctrine:schema:update --force

INSTALL SYMFONY CLI:

curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash




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

migrations:
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
php bin/console cache:clear


symfony server:start

# example for create entity :

*   php bin/console make:entity '\App\Test\User\Domain\User'
