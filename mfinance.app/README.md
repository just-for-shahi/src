## MFinance - Core

## Swagger Laraval
url: `http://127.0.0.1:8000/swagger`
generate: `php artisan l5-swagger:generate`
### sample
```php
    /**
     * @OA\Get(
     *     path="/health",
     *     @OA\Response(response="200", description="check health")
     * )
     */
    public function health()
    {
        try {
            return  "health checked";
        } catch (\Exception $e) {
            InternalServerError500($e);
        }
    }
```
