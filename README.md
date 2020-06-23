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

  $postModel = Post::fromArray(
  $client,
  [
    'modified' => "2010-01-02T15:04:05Z",
    'external_id' => 'FN2',
    'integration_id' => 6,
    'source_url' => 'https://www.fussball.news/FN1',
    'language' => 'de',
    'published' => "2010-01-02T15:04:05Z",
    'title' => 'Title',
    'content' => '<div>Content</div>',
    'image_url' => 'https://www.fussball.news/FN1.jpg',
    'image_width' => 1200,
    'image_height' => 800,
    ]
  );
  $client->post()->create($postModel);
// OR 
  $client->post()->update($postModel);
// OR
  $client->post()->createOrUpdate($postModel);
    
```

## Running tests

```
 ./vendor/bin/phpunit --no-configuration /var/www/test
```