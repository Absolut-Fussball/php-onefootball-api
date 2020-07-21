<?php

namespace Onefootball\Tests\Api;

use GuzzleHttp\Psr7\Response;
use OneFootball\Model\Post;
use OneFootball\Tests\TestBase;

class PostTest extends TestBase
{

    /**
     * @test
     */
    public function shouldCreatePost()
    {
        $httpClient = $this->getHttpClient(
          [
            new Response(
              200,
              [],
              '{}'
            ),
          ]
        );
        $client = $this->authenticate($httpClient);

        $postModel = Post::fromArray(
          $client,
          [
            'external_id' => 'FN2',
            'integration_id' => 310,
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

        // 1 Call creates.
        $result = $client->post()->create($postModel);
        $this->assertNotNull($result);
    }

    /**
     * @test
     */
    public function shouldGetPostId()
    {
        $httpClient = $this->getHttpClient(
          [
            new Response(
              200,
              [],
              '{"posts":[{"id":9269,"external_id":"FN2","integration_id":6,"content":"\u003cdiv\u003eContent\u003c/div\u003e","image_url":"https://www.fussball.news/FN1.jpg","image_width":1200,"image_height":800,"breaking_news":false,"source_url":"https://www.fussball.news/FN1","title":"Title","language":"de","published":"2010-01-02T15:04:05Z","modified":"2010-01-02T15:04:05Z","synced":true,"draft":false}]}'
            )
          ]
        );
        $client = $this->authenticate($httpClient);
        $external_id = $client->post()->getPostIdByExternalId('FN2');
        $this->assertNotNull($external_id);
    }

    /**
     * @test
     */
    public function shouldUpdatePost()
    {
        $httpClient = $this->getHttpClient(
          [
            new Response(
              200,
              [],
              '{}'
            )

          ]
        );
        $client = $this->authenticate($httpClient);

        $postModel = Post::fromArray(
          $client,
          [
            'id' => '9269',
            'modified' => "2010-01-02T15:04:05Z",
            'external_id' => 'FN2',
            'integration_id' => 310,
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
        $result = $client->post()->update($postModel);
        $this->assertNotNull($result);
    }


    /**
     * @test
     */
    public function shouldUpdateOrCreatePost()
    {
        $httpClient = $this->getHttpClient(
          [
            new Response(
              200,
              [],
              '{"posts":[{"id":9269,"external_id":"FN2","integration_id":6,"content":"\u003cdiv\u003eContent\u003c/div\u003e","image_url":"https://www.fussball.news/FN1.jpg","image_width":1200,"image_height":800,"breaking_news":false,"source_url":"https://www.fussball.news/FN1","title":"Title","language":"de","published":"2010-01-02T15:04:05Z","modified":"2010-01-02T15:04:05Z","synced":true,"draft":false}]}'
            ),
            new Response(
              200,
              [],
              '{"id":9269,"external_id":"FN2","integration_id":6,"content":"\u003cdiv\u003eContent\u003c/div\u003e","image_url":"https://www.fussball.news/FN1.jpg","image_width":1200,"image_height":800,"breaking_news":false,"source_url":"https://www.fussball.news/FN1","title":"Title","language":"de","published":"2010-01-02T15:04:05Z","modified":"2010-01-02T15:04:05Z","synced":true,"draft":false}'
            )

          ]
        );
        $client = $this->authenticate($httpClient);

        $postModel = Post::fromArray(
          $client,
          [
            'modified' => "2010-01-02T15:04:05Z",
            'external_id' => 'FN2',
            'integration_id' => 310,
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
        $result = $client->post()->createOrUpdate($postModel);
        $this->assertNotNull($result);
    }

    protected function getApiClass()
    {
        return 'OneFootball\Api\Post';
    }
}
