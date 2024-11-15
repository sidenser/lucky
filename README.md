Deployment

```docker compose up -d --build```

```docker compose exec php bash```


``chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache``

``chmod -R 775 /var/www/storage /var/www/bootstrap/cache``

```composer install```

```php artisan migrate```

```npm ci```

```npm run build```


From the second time onwards

```docker compose up -d```

