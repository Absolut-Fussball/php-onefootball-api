<?php

namespace Onefootball\Tests\Model;

use OneFootball\Model\Post;
use OneFootball\Tests\TestBase;

class PostTestBase extends TestBase
{
    public function testPost()
    {
        $client = $this->authenticate();
        $postModel = Post::fromArray(
          $client,
          [
            'external_id' => 'FN2',
            'integration_id' => '310',
            'source_url' => 'https://www.fussball.news/FN2',
            'language' => 'de',
            'draft' => true,
            'published' => 1,
            'title' => 'Title',
            'content' => '<div>Content</div>',
            'image_url' => 'https://www.fussball.news/FN1.jpg',
            'image_width' => 1200,
            'image_height' => 800,
          ]
        );
        $this->assertNotNull($postModel);
    }
}
