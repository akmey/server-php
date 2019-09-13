# Akmey

## PHP main server

Akmey is a keyserver, but not for GPG keys, for SSH ones! It is bundled with tools for Linux/Mac OS/Windows.

## Install 

- Clone the repository
- Create the `.env` based on `.env.example`
- Fetch the deps using `composer install -o --no-dev`
- Fetch the webclient deps using `npm install`
- Build Semantic UI : `cd resources/semantic; gulp build`
- Build the webclient using `npm run production`
- Make sure permissions are corrects
- `php artisan migrate` : create the schemes
- `php artisan passport:install` : creates OAuth keys
- `php artisan passport:client --password` : create a password grant client (for SSH subserver)
- Proxy that through Nginx or Apache and Akmey is ready!

_Now you can continue by installing the Akmey SSH subserver to deposit keys easily._
