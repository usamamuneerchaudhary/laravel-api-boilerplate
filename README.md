<h1 align="center">
Laravel API Boilerplate using Laravel Passport 
</h1>


Laravel API Boilerplate is a "starter kit" you can use to build your first API. As you can easily imagine, it is
 built on top of the awesome Laravel Framework. This version is built on Laravel 6.0!

It is built on top of:

- Laravel Passport - [laravel/passport](https://github.com/laravel/passport)
- Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

## Installation

1. run `composer create-project usamamuneerchaudhary/laravel-api-boilerplate
 newProject`;
2. Install project dependencies by running `composer install`

3. Rename `.env.example` to `.env`
4. Generate Passport encryption keys & secret access tokens `php artisan passport:install`
5. Generate application key by `php artisan key:generate`
6. After DB Connection, run `php artisan migrate`. For dummy data for users, run `php artisan migrate --seed`. You can see more info in `database\seeds\UserTableSeeder.php`.
7. For Testing Emails, you can setup MailTrap.

8. Well that's it lad, it would be up and running on your server already.

## Basic Requirements for the Project
1. PHP `v7.2` or greater.
2. PgSQL`v10.4` or greater.
## Main Features

### Ready-To-Use Authentication Controllers

You don't have to worry about authentication and password recovery anymore. I created four controllers you can find in the `App\Api\V1\Controllers` for those operations.

For each controller there's an already setup route in `routes/api.php` file:

- `POST api/auth/login`, to do the login and get your access token or to refresh your existent token;
- `POST api/auth/register`, to create a new user into your application;
- `POST api/auth/recovery`, to recover your credentials;
- `POST api/auth/reset`, to reset your password after the recovery;
- `POST api/auth/logout`, to log out the user by invalidating the passed token;

### Separate File for Routes

All the API routes can be found in the `routes/api.php` file. This also follow the Laravel convention.

### Secrets Generation

Every time you create a new project starting from this repository, the _php artisan passport:keys_ command will be executed.

## Configuration

As I already said before, this boilerplate is based on _laravel/passport_ and _dingo/api_ packages. So, you can find many information about configuration <a href="https://laravel.com/docs/5.8/passport" target="_blank">here</a> and <a href="https://github.com/dingo/api/wiki/Configuration" target="_blank">here</a>.

There are also the validation rules for every action (login, sign up, recovery and reset) inside `app/Api/V1/Requests` directory. Feel free to customize them for your needs.

## Creating Endpoints

You can create endpoints in the same way you could to with using the single _dingo/api_ package. You can <a href="https://github.com/dingo/api/wiki/Creating-API-Endpoints" target="_blank">read its documentation</a> for details. After all, this is just a boilerplate! :smirk:

However, I added some example routes to the `routes/api.php` file to give you immediately an idea.

## Cross Origin Resource Sharing

If you want to enable CORS for a specific route or routes group, you just have to use the _cors_ middleware on them.

Thanks to the _barryvdh/laravel-cors_ package, you can handle CORS easily. Just check <a href="https://github.com/barryvdh/laravel-cors" target="_blank">the docs at this page</a> for more info.

## Code styling

PHP-CS-Fixer is used for strong :muscle: style guidelines.

PHP is pre-configured for official Laravel styling, just launch `vendor\bin\php-cs-fixer fix` for global project auto-formatting.

## Tests

If you want to contribute to this project, feel free to do it and open a PR. However, make sure you have tests for what you implement.

In order to run tests:

- run `vendor\bin\phpunit`;

## Feedback

I made this project for personal purposes. I decided to share it here to help anyone with the same needs :innocent:. If you have any feedback to improve it, feel free to make a suggestion, or open a PR!

## License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).



