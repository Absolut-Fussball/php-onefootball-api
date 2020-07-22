<?php

namespace OneFootball\Api;

use OneFootball\Model\Post as PostModel;

class Post extends AbstractApi
{

    private function getProjectPath($post_id = '')
    {
        return $this->client->getUrl() . '/v1/posts/' . $post_id;
    }
    /**
     * @param PostModel $post
     *
     * @return mixed
     */
    public function createOrUpdate(PostModel $post)
    {
        if ($post->id == null) {
            $id = $this->getPostIdByExternalId($post->external_id);
            if ($id == null) {
                $result = $this->create($post);
            } else {
                $post->id = $id;
                $result = $this->update($post);
            }
        } else {
            $result = $this->update($post);
        }
        return $result;
    }

    /**
     * @param PostModel $post
     *
     * @return mixed
     */
    public function create(PostModel $post)
    {
        return $this->post($this->getProjectPath(), $post->getData());
    }

    /**
     * @param int $post_id
     *
     * @return mixed
     */
    public function show($post_id)
    {
        return $this->get($this->getProjectPath($post_id));
    }

    /**
     * @param int $post_id
     *
     * @return mixed
     */
    public function showAll($post_id)
    {
        return $this->get($this->getProjectPath());
    }

    /**
     * @param string $external_id
     *
     * @return string
     */
    public function getPostIdByExternalId($external_id)
    {
        $response = $this->get(
          $this->getProjectPath(),
          ['external_id' => $external_id]
        );
        $post = current($response->posts);
        return $post != null ? $post->id : null;
    }

    /**
     * @param PostModel $post
     *
     * @return mixed
     */
    public function update(PostModel $post)
    {
        return $this->put($this->getProjectPath($post->id), $post->getData());
    }

    /**
     * @param int $post_id
     *
     * @return mixed
     */
    public function remove($post_id)
    {
        return $this->delete($this->getProjectPath($post_id));
    }
}
