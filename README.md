# Mario Laps API

## Prerequisite

- Docker (or Docker for Mac)
- PHP (7.3)
- Composer
- Git
- MySQL Workbench (or Sequel Pro, or anything else to connect into databases)

## Setup

- Open terminal, navigate to the root folder of the app, e.g. `/Users/abc/mario-laps-backend`.
- In your terminal, type `composer install` to install all dependencies.
- In your terminal, type `docker-compose up` to bring the containers up.
You can test it works by accessing the URL localhost:7777 and see the Laravel default page.
You can also test by opening Sequel Pro and trying to connect to the database.
Name: anything you want, this is just for you.
Host: 127.0.0.1
Username: mariolaps
Password: password
Database: mariolaps
Port: 3333
- In another terminal, `docker exec -it mariolaps_app bash` to open a terminal inside the container mariolaps_app.
The terminal name on the left should look like `bash-5.0#`.
- *If this is the first time* type `php artisan migrate:fresh && php artisan db:seed`.
