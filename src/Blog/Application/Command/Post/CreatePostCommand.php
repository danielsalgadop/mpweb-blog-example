<?php

namespace Blog\Application\Command\Post;


class CreatePostCommand
{
    private $title;
    private $body;

    public function __construct(string $title, string $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function title():string
    {
        return $this->title;
    }

    public function body():string
    {
        return $this->body;
    }
}

