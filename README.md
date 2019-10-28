<h1 align="center">
Laravel API Boilerplate using Laravel Passport 
</h1>


Laravel API Boilerplate is a starting point for your first API.

It is built on top of:

- Laravel Framework - [laravel/laravel](https://github.com/laravel)
- Laravel Passport - [laravel/passport](https://github.com/laravel/passport)
- Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

## Installation

1. run `composer create-project usamamuneerchaudhary/laravel-api-boilerplate myfirstApi`;

3. Rename `.env.example` to `.env`
4. Generate Passport encryption keys & secret access tokens `php artisan passport:install`
5. Generate application key by `php artisan key:generate`
6. After DB Connection, run `php artisan migrate`. For dummy data for users, run `php artisan migrate --seed`. You can see more info in `database\seeds\UserTableSeeder.php`.
7. For Testing Emails, you can setup MailTrap.

8. Well that's it lad, it would be up and running on your server already.

## Basic Requirements for the Project
1. PHP `v7.3` or greater.

## Main Features

### Ready-To-Use Authentication Controllers

You can find Authentication Controllers under namespace `App\Http\Controllers\API\Auth`. 

### Validations

There are also the validation rules for every action (login, sign up, recovery and reset) under namespace ` App\Http
\Request\API\Auth`.

### Endpoints

- Login: `POST api/v1/login`
- Register: `POST api/v1/register` 
- Recover `POST api/v1/recover`
- Reset `POST api/v1/reset`
- Find Reset Token `GET api/v1/reset/{token}`
- Logout `GET api/v1/logout`
- Verify Email `api/v1/user/verify/email/{token}`

Please note that, api routes are prefixed with `v1`, you can changed this in `App\Providers\RouteServiceProvider.php`

### Separate File for Routes

All the API routes can be found in the `routes/api.php` file.

### Firewall

We're using [akaunting/firewall
](http://github.com/akaunting/firewall) to secure our API.

### Roles & Permissions 

Simpler way of assigning Roles & Permissions to Users. You can more details on what we've done here on  [usamamuneerchaudhary/roles-permissions](https://github.com/usamamuneerchaudhary/roles-permissions) 

## Creating Endpoints

You can create your endpoints in `routes/api.php` under `auth:api` middleware group. 

## Cross Origin Resource Sharing

If you want to enable CORS for a specific route or routes group, you just have to use the _cors_ middleware on them.

Thanks to the _barryvdh/laravel-cors_ package, you can handle CORS easily. Just check <a href="https://github.com/barryvdh/laravel-cors" target="_blank">the docs at this page</a> for more info.

## License

This project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).



