## Campaign App

Simple campaign crud app built with Laravel and React.js. This app uses api built with Laravel and in front end uses React.js to display pages.

## Installation

-   Clone the repository: `https://github.com/akibtanjim/campaign-app.git`
-   Copy `.env.example`to `.env`. Fill this with appropriate value
-   Run the following `docker run --rm \ -u "$(id -u):$(id -g)" \ -v $(pwd):/var/www/html \ -w /var/www/html \ laravelsail/php81-composer:latest \ composer install --ignore-platform-reqs`
-   In order make sail alias : `alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'`
-   Run `sail php artisan key:generate` to generate key
-   Run `sail artisan storage:link`
-   Run `sail up -d`
-   Run `sail artisan migrate`
-   Run `sail artisan db:seed --class=CampaignTableSeeder`
-   Run `sail npm i`
-   Run `npm run dev`
-   Project url: `http://localhost`
-   Postman Collection: `docs/Campaign App.postman_collection.json`
