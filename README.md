# Sample Laravel RESTFul service

Simple laravel RESTFul API service demo using Observers, Queues & Contracts.

Example API's:
- [POST] Create `http://127.0.0.1/api/v1/websites/{websiteId}/posts`
- [GET] Posts `http://127.0.0.1/api/v1/websites/{websiteId}/posts`
- [Post] Subscribe `http://127.0.0.1/api/v1/websites/{websiteId}/subscribe`
- [GET] Subscribers `http://127.0.0.1/api/v1/websites/{websiteId}/subscribers`

## Installation
1. Checkout the source code and navigate to project directory.
2. cp src/.env.example src/.env and do the appropriate changes to db variables.
3. Update composer `docker run --rm     -v "$(pwd)/src":/opt     -w /opt     laravelsail/php80-composer:latest     bash -c "composer update"`
4. Execute command `docker-compose up -d`
5. Execute the migration scripts.
    - `docker exec laravel-restful.app php artisan migrate`
6. Staring queue to send emails
    - `docker exec laravel-restful.app php artisan queue:work`


> Postman API spec is available at `./postman-spec`

> TODO: Vendor directory can be excluded to the commits of git repository while building an custom docker image.
