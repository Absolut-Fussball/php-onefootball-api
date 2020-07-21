<?php

namespace OneFootball\Model;

use OneFootball\Client;

/**
 * Class Post
 *
 * @property-read string $external_id
 * @property-read string $draft
 * @property-read string $integration_id
 * @property-read string $source_url
 * @property-read string $published
 * @property-read string $content
 * @property-read string $title
 * @property-read string $modified
 * @property-read string $image_url
 * @property-read string $image_width
 * @property-read string $image_height
 */
class Post extends AbstractModel
{
    /**
     * @var array
     */
    protected static $properties = array(
        "id",
        "external_id",
        "integration_id",
        "source_url",
        "language",
        "draft",
        "published",
        "content",
        "modified",
        "title",
        "image_url",
        "image_width",
        "image_height"
    );

    /**
     * @param Client  $client
     * @param Post $post
     * @param array   $data
     *
     * @return Post
     */
    public static function fromArray(Client $client, array $data)
    {
        $post = new static($client);
        return $post->hydrate($data);
    }

    /**
     * @param array $data
     * @param Client $client
     */
    public function __construct($client)
    {
        $this->setClient($client);
    }
}
