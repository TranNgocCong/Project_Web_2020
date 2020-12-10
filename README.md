# Project_Web_2020
Install composer `composer install`
 Install npm package `npm install`
 Copy and edit .env file from .env.example `cp .env.example .env`
 Generate project key `php artisan key:generate`
 Create an empty database `test` for example
 In the .env file, change database information `DB_DATABASE=test1`
 Migrate the database `php artisan migrate`
 Create symbolic link for storage `php artisan storage:link`
 Run project `php artisan serve`
