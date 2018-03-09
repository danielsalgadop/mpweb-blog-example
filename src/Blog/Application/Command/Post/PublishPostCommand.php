<?php

namespace Blog\Application\Command\Post;


class PublishPostCommand
{
    private $postId;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }

    public function postId():int
    {
        return $this->postId;
    }
}

