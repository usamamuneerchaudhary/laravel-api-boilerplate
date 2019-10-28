# Rentable API

## Steps for setting up

1. Clone or Fork the project.
2. Install project dependencies by running `composer install`

3. Rename `.env.example` to `.env`
4. Generate Passport encryption keys & secret access tokens `php artisan passport:install`
5. Generate application key by `php artisan key:generate`
6. After DB Connection, run `php artisan migrate`. For dummy data for users, run `php artisan migrate --seed`, it
 will create two users for you `usama@rentable.pl` and `asad@rentable.pk`. You can see more info in `database\seeds\UserTableSeeder.php`.
7. For Testing Emails, you can setup MailTrap.

8. Well that's it lad, it would be up and running on your server already.

## Basic Requirements for the Project
1. PHP `v7.2` or greater.
2. PgSQL`v10.4` or greater.


