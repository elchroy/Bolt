# Bolt

[![Coverage Status](https://coveralls.io/repos/github/andela-celisha-wigwe/Bolt/badge.svg?branch=develop)](https://coveralls.io/github/andela-celisha-wigwe/Bolt?branch=develop)
[![Build Status](https://travis-ci.org/andela-celisha-wigwe/Bolt.svg?branch=develop)](https://travis-ci.org/andela-celisha-wigwe/Bolt)
[![StyleCI](https://styleci.io/repos/58325168/shield)](https://styleci.io/repos/58325168)

![alt tag](https://github.com/andela-celisha-wigwe/Bolt/blob/develop/public/img/bolt-logo.png)

[Bolt](https://boltt.herokuapp.com) is a Learning Management System built with the [Laravel](http://www.laravel.com), an opensource [PHP](http://www.php.net) framework with an expressive and elegant syntax.

Bolt offers users the ability to manage their learning of some of the best and popular computer programming languages.

## Requirements

To use this application, install the following key requirements.

- [PHP](http://www.php.net) at least 5.5.*
- [Composer](http://www.getcomposer.com)
- Apache
- Database

## Installation

You can install the application by forking this repo or cloning it to your desktop.

Run `composer install` to install laravel and all dependencies

Run `php artisan key:generate` and copy the generated APP key.

Create a `.env` file at the root of your applicationa add the credentials as follows:

```ENV


APP_ENV=local

APP_DEBUG=true

APP_KEY=your_generated_app_key

APP_URL=your_host


DB_CONNECTION=pgsql

DB_HOST=database_localhost

DB_PORT=5432

DB_DATABASE=database_name

DB_USERNAME=database_username

DB_PASSWORD=database_password


CACHE_DRIVER=file

SESSION_DRIVER=file

QUEUE_DRIVER=sync


```

Run migrations:

```PHP

php artisan db:migrate

```
and seed the database with random data:

```PHP

php artisan db:seed

```

## Environment

### Social Authentication

For social authentication, with Facebook, Twitter and GitHub, include the following in your `.env` file with the correct credentials.
```ENV

FACEBOOK_CLIENT_ID

FACEBOOK_CLIENT_SECRET

FACEBOOK_REDIRECT=http://yourhost:yourport/auth/facebook/callback


TWITTER_CLIENT_ID

TWITTER_CLIENT_SECRET

TWITTER_REDIRECT=http://yourhost:yourport/auth/twitter/callback


GITHUB_CLIENT_ID

GITHUB_CLIENT_SECRET

GITHUB_REDIRECT=http://yourhost:yourport/auth/github/callback

```


### Cloudinary

Bolt uses Cloudinary to handle image uploads. Ensure your `.env` file includes the correct APP keys and secrets, as follows:

```ENV


CLOUDINARY_CLOUD_NAME

CLOUDINARY_API_KEY

CLOUDINARY_API_SECRET

```

### Mails

All mails sent with Bolt are sent using Swift. To send mails, you need to include your username also. Note, for security purposes, include your password onlyh when testing this functionality.

```ENV


MAIL_USERNAME=your_gmail_username

MAIL_PASSWORD=your_gmail_password

```

## Features

### Users

- User Registration
- Traditional Authentication
- Social Authentication (integration with [Facebook](http://www.facebook.com), [Twitter](http://www.twitter.com) and [GitHub](http://www.github.com))
- Dashboard (requires authentication)
- Password Reset (unauthenticated users that have accounts)
- User Edit Profile (authenticated users)

### Videos

- View all (all users)
- View by categories (all users)
- View By Search (all users)
- Watch a Video (all users)
- Upload a video resource (only authenticated users, only valid youtube users)
- Edit a video resource (only authenticated users)
- Delete a video resource (only authenticated users)
- Drop Comments on a video (only authenticated users)
- Favorite a video (only authenticated users)

### Categories

- View all categories (all users)
- View all videos under a particular category (all users)
- Add new category (only authenticated users)
- Editing a category (only authenticated users)

## Tests

To run tests, using Command Prompt or Terminal ensure to cd into the root of the application's directory.

Run `phpunit`

## Security Vulnerabilities

If you discover a security vulnerability within Bolt, please send an e-mail to Chijioke Elisha-Wigwe at chijioke.elisha-wigwe@andela.com. All security vulnerabilities will be promptly addressed.

## License

Bolt is built buy [Chijioke Elisha-Wigwe](http://www.github.com/andela-celisha-wigwe) with the Laravel framework, an open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT). Bolt is named after my dog, from whom inspiration is drawn.	
