A PHP wrapper to be used with [OneFootball API](https://onefootball-demo.readthedocs.io/en/latest/api.html).
==============


## Sample usage

```
    use OneFootball\Client;
    $client = new Client('URL', $httpClient);
    $client->authenticate(
       'sample@example.com',
       'pw_provided_by_onefootball'
    );

    
    
```

## Running tests

```
 ./vendor/bin/phpunit --no-configuration /var/www/test
```