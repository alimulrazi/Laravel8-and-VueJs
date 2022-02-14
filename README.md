

## Laravel Installation Steps

- **[npm install && npm run dev]**
- **[php artisan jetstream:install livewire]**
- **[php artisan jetstream:install livewire --teams]**
- **[php artisan storage:link]**


## Jetstream modification process
- Locate the file in the config folder called jetstream.php and look for 'features' key in the returned array and uncomment the Features::profilePhotos()

- go to .env and change app uri to this APP_URL=http://localhost:8000

-in terminal enter: php artisan serve
