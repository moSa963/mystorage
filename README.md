# MyStorage
A simple website gives users a way to store and share their files

## Preview

https://github.com/moSa963/mystorage/assets/65834849/5d5efa73-0568-42ce-a7ff-182233a5627c

## Prerequisites
  - you should ensure that your local machine has PHP and [Composer](https://getcomposer.org/) installed. for more information visit [laravel docs](https://laravel.com/docs/9.x/installation)
  - Make sure your local machine has [Nodejs](https://nodejs.org/) installed.
  
## Clone & install

* Clone this repo

* Run `cd my-storage` to change directory

* Run `cp .env.example .env` to create .env file from ".env.example"

* Make sure to create a new database and add your database credentials to your .env file

  ```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=database_name
  DB_DATABASE_TEST=database_name_test
  DB_USERNAME=root
  DB_PASSWORD=
  ```
* Run `composer install`

* Run `npm install`

* Run `php artisan key:generate`

* Run `php artisan migrate` to create database tables

* Run `php artisan db:seed` if you want to load some random data to your database for test purposes
 
* Run `php artisan serve` to start the server

### If you did run `php artisan db:seed`, you can login using this credentials

  >**username:** `admin`   
  >**password:** `password`
