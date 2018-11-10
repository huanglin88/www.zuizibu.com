## Web Server Configuration

### Pretty URLs
#### Apache
```
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
```
#### Nginx
```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## Installation
#### Command
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:install
php artisan db:init
```