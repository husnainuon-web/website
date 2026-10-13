# Deploying to InfinityFree

This project needs PHP 8.2 or newer and MySQL/MariaDB. The package keeps the
Laravel application under `htdocs/core` and exposes only the front controller,
static assets, and uploaded product media from `htdocs`.

## 1. Build the upload package

From the project root on Windows, run:

```powershell
powershell -ExecutionPolicy Bypass -File .\deploy\infinityfree\package.ps1
```

The script creates a timestamped folder under `deployment-output` containing
an `htdocs` directory ready to upload with FTP. It includes the installed
Composer `vendor` dependencies, does not include `.env` or Git data, and copies
current public product uploads into `htdocs/storage`.

If `vendor` is missing, run `composer install --no-dev --optimize-autoloader`
from the project root before building the package.

## 2. Create the website and database

In the InfinityFree control panel, add the domain/subdomain, select PHP 8.2 or
newer if a PHP selector is available, and create a MySQL database. Copy the
database host, name, username, and password exactly as shown in the panel.
Enable HTTPS before relying on secure session cookies.

## 3. Upload the files

Use FTP to upload the **contents** of the package's `htdocs` folder into the
website's `htdocs` directory. The resulting layout must be:

```text
htdocs/
  .htaccess
  index.php
  build/                 (if the project has built Vite assets)
  storage/               (public product images/videos)
  core/
    .htaccess
    .env.example
    app/
    bootstrap/
    vendor/
    ...
```

Do not remove `core/.htaccess` or `htdocs/.htaccess`: they prevent visitors
from directly requesting the private Laravel source and route requests through
Laravel. Do not upload your local `.env` file.
Ensure `core/storage`, `core/bootstrap/cache`, and the public `storage`
directory are writable by PHP using the permissions supported by the host.

## 4. Configure production settings

In FTP/File Manager, copy `core/.env.example` to `core/.env` and edit it:

- `APP_URL` is prefilled as `https://zainstore.infinityfree.com`; confirm HTTPS
  is active for the domain before keeping `SESSION_SECURE_COOKIE=true`.
- Set `APP_KEY` to a fresh key generated locally with
  `php artisan key:generate --show`; keep it private and do not commit it.
- Replace the four database settings with the values from the hosting panel.
- Keep `APP_ENV=production`, `APP_DEBUG=false`, and
  `SESSION_SECURE_COOKIE=true` after HTTPS is active.

The `file` session/cache stores and synchronous queue avoid requiring extra
database tables or a background worker for these Laravel services.

## 5. Create the database tables

The hosting file manager does not run Laravel migrations automatically. Create
the schema using the project's migrations in a local MySQL database, export
the **structure** as SQL from phpMyAdmin, and import that SQL into the
InfinityFree database with phpMyAdmin. If your hosting account permits a
connection from your local machine to its database, you can instead configure
the local `.env` with the hosting database values and run:

```powershell
php artisan migrate --force
```

Do not run migrations against a database containing data you need to preserve
without taking a backup first. Create an admin account separately; never use
the development `.env` or commit a real admin password.

## 6. Check the deployment

Open the HTTPS website and test product browsing, product images/videos,
registration/login, cart, checkout, quotations, and the admin area. If a page
shows a 500 error, check `core/storage/logs/laravel.log` through FTP and confirm
the hosting PHP version and required PHP extensions. Keep `APP_DEBUG=false`
on the public site.

Product uploads are written to `htdocs/storage`, which is public by design.
When publishing later code updates, do not overwrite or delete that directory;
it contains the live product media. Back up the database and this directory
before replacing application files.

## Hosting limitations

Free shared hosting can enforce PHP upload and execution limits. The admin
product video upload is currently capped at 20 MB by the application; if the
host's PHP upload limit is lower, reduce the upload size or use a hosting plan
with a higher limit.
