# Laravel Uptime Monitor

This project has been created to test Spatie's **Laravel Uptime Monitor** package using **Filament Admin Panel**. This
concept is not intended for production purposes as it is not feature complete.

## Packages

The following packages have been used:

- [Laravel Livewire](https://laravel-livewire.com/) - Included with Jetstream (and Filament).
- [Filament admin panel](https://filamentphp.com/docs/2.x/admin/installation) - Admin panel displaying the uptime status
- Spatie's [Laravel Uptime Monitor](https://spatie.be/docs/laravel-uptime-monitor/v3/introduction)

!['monitor](./docs/monitor.png 'Monitor dashboard')

### Dev Tooling

- [Laravel debug bar](https://github.com/barryvdh/laravel-debugbar) - debug bar for views, shows models, db calls etc.

## Requirements

This is a Laravel 9 project. The requirements are the same as a
new [Laravel 9 project](https://laravel.com/docs/9.x/installation).

- [8.0+](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org)

Recommended:

- [Git](https://git-scm.com/downloads)

## Clone

Clone the project repository

e.g.

```sh
git clone git@github.com:Pen-y-Fan/laravel-uptime-monitor.git
```

## Install

Install all the dependencies using composer

```sh
cd laravel-uptime-monitor
composer install
```

## Create .env

Create an `.env` file from `.env.example`

```shell script
cp .env.example .env
```

## Configure Laravel

This project uses models and seeders to generate the tables for the database. Tests will use the seeded data. Configure
the Laravel **.env** file with the **database**, updating **username** and**password** as per you local setup.

```text
APP_NAME="Laravel uptime monitor"

APP_URL=https://laravel-uptime-monitor.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_uptime_monitor
DB_USERNAME=YourDatabaseUserName
DB_PASSWORD=YourDatabaseUserPassword
```

## Generate APP_KEY

Generate an APP_KEY using the artisan command

```shell script
php artisan key:generate
```

## Create the database

The database will need to be manually created e.g.

```shell
mysql -u YourDatabaseUserName
CREATE DATABASE laravel_uptime_monitor CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
exit
```

## Install Database

This project uses models and seeders to generate the tables for the database. Tests will use the seeded data.

```shell
php artisan migrate
# or if previously migrated: 
php artisan migrate:fresh
```

## NPM

There is no need to run any npm commands, filament already has the assets compiled.

## Configuration

Spatie's **Laravel Uptime Monitor** has been configured to run checks every five minutes, see
**config/uptime-monitor.php** and **app/Console/Kernel.php**.

### Email notification

See the **config/uptime-monitor.php** to update the to mail address:

```php
 'mail' => [
            'to' => ['your@email.com'],
        ],
```

Other notification providers, such as **slack**, can also be used. For further information see the
official [spatie > installation and setup](https://spatie.be/docs/laravel-uptime-monitor/v3/installation-and-setup)
documentation. It is also possible to
[Customize notifications](https://spatie.be/docs/laravel-uptime-monitor/v3/advanced-usage/customizing-notifications).

### Add sites

To add sites to monitor run the artisan command provided by the spatie package:

```shell
php artisan monitor:create https://example.com
```

Change **example.com** to the domains you wish to monitor. Repeat the command for all your domains.

### Start monitoring

Once all the domains have been added, Laravel can be set to monitor them:

```shell
php artisan schedule:work
```

## Filament

Filament admin panel has been configured to easily view the results.

### Create an account

Create a filament user account:

```shell
php artisan make:filament-user
```

Give the user a name, email and password

### Log in

Open your browser to your project's web page /admin uri, e.g. <https://laravel-uptime-monitor.test/admin>

Sign in with the username and password set above.

#### Dashboard

The **Dashboard** will display a card for each site being monitored (see screenshot above).

#### Monitor

Click the **Monitor** menu item to view a table view.

#### Detail

Click an item in the table to see the **details**.

#### Delete

It is also possible to delete a site from the table by scrolling to the right and clicking **Delete**. This is
equivalent to:

```shell
php artisan monitor:delete <url>
```

### Create and Edit

No edit or create view has been made, as the package has an artisan command to create. If required see
[Manually modifying monitors](https://spatie.be/docs/laravel-uptime-monitor/v3/advanced-usage/manually-modifying-monitors)

## Contributing

This is a **personal project**. Contributions are **not** required. Anyone interested in developing this project are
welcome to fork or clone for your own use.

This project is not recommended for production use. Additional feature such as:

- roles and permissions, for viewer (product owner) and admin would be recommended -
  see [Shield](https://filamentphp.com/plugins/shield) plugin
- create and edit form
- action to enable/disable

## Credits

- [Michael Pritchard \(AKA Pen-y-Fan\)](https://github.com/Pen-y-Fan).

## License

MIT License (MIT). Please see [License File](LICENSE.md) for more information.
