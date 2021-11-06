# Gateway Microservice

This gateway connect the books microservice with authors microservice.
It use OAuth2 security.

## Instructions

- Clone this repository
- Install composer dependencies ``` composer install ```
- Copy .env.example in .env
- Change database connection config
- Execute ``` php artisan migrate ``` to run database migrations
- You will need to create passport clients, so execute: ``` php artisan passport:install ``` and copy secret credentials
- Set BOOKS_SERVICE_SECRET and AUTHORS_SERVICE_SECRET in .env with corresponding API KEYS generated for ms-authors and ms-books
<https://github.com/fedejuret/ms-books> | <https://github.com/fedejuret/ms-authors>
- Then run ``` php -S localhost:8002 -t ./public ```

## How to use

Now, you will need a HTTP Client, I recommend use Postman. Once that you have Postman, open it and send a POST request to: ``` localhost:8002/oauth/token ```
In the request body, you need to send theese params:

| Param | Value |
|-------|-------|
|grant_type       | client_credentials |
|client_id | Generated client id when you ran: ``` php artisan passport:install ```
|client_secret| Generated client secret when you ran: ``` php artisan passport:install ```

This post request will return you an access_token. This access_token you will need to send it in all request that you will make
