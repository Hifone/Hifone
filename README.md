## Hifone

![Screenshot](https://camo.githubusercontent.com/b7d53bb60a3b98e42ad3e04974a57aaacce460e7/687474703a2f2f363438322e636f6d2f6869666f6e65312e706e67)

Hifone is a free, open-source, self-hosted forum software based on the Laravel PHP Framework.

## Features

* Fast and simple
* Beautiful and responsive
* Roles & Permissions
* Markdown & Emoj
* Image upload
* Avatars
* Notifications
* RSS Feeds
* Localization: language files, time zone and UTF-8 support

## Requirements

There are a few things that you will need to have set up in order to run Gitamin:

- A web server: **Nginx**, **Apache** (with mod_rewrite), or **Lighttpd**
- **PHP 5.6.4+** with the following extensions: mbstring, pdo_mysql
- **MySQL** or **PostgreSQL**
- **Composer**

## Installation

```shell
git clone https://github.com/Hifone/Hifone
cd Hifone
composer install --no-dev -o
cp .env.example .env
php artisan migrate
php artisan key:generate
php artisan config:cache
```
Once cloned to your local machine, you'll need some demo data! Simply run `php artisan hifone:seed` to get the demo installation on the go.

## Development

These extra dependencies are required to develop Hifone:

- Node.js
- Bower
- Gulp

```shell
npm install
bower install
gulp
```

If you're making a lot of changes, you'll find that running `gulp watch` will really help you out!

## Demo

[Hifone website](http://hifone.com/).


