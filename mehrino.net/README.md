 ## Laravel 

### Development requirements

* laravel *8.0
* git
* mysql 5.latest
* redis
* php *7.4
* composer 3
* bugsnag *2.0
* google *2.8
* passport *10.8
* l5-swagger

## Getting started

To set up your environment, you should go through the following steps. Depending on your scenario, some of the steps might not be required.

### 1. Create the repo

Using the template as a baseline commit for microservices is not mandatory. You might prefer to simply use the template as a reference and copy the relevant bits across manually.

### 2. Run the initialisation laravel
Run the `composer install` PowerShell script. This will create a vendor

 ### 3. Set the application key
 Run the `php artisan key:generate ` PowerShell script.
 ### 4. Create the migration repository
 Run the ` php artisan migrate` PowerShell script.
### 5. Repository structure

Starting repository structure is as follows:

``` bash
├────app
├────database
├────test
├────service
├──────{microservice name}
├────────Controllers
├────────Middleware
├────────Migrations
├────────Models
├────────Repositories
├────────Routes
├────────Provider
├────────Helpers
├────────Tests
```

# Publish
```bash
$_> cd mehrino
$_> composer install
$_> cp .env.example .env  //set master envirment and set key
$_> php artisan key:generate //only once in project
$_> php artisan migrate 
$_> php artisan l5-swagger:generate 
$_> php artisan passport:install //only once in project
$_> php artisan queue:work --queue=high,low //runtime 
$_> end
```
## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
