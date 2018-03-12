<?php

namespace Blog\Application\Command\Post;


class FindPostsCommand
{
    private $onlyPublished;

    public function __construct(bool $onlyPublished)
    {
        $this->onlyPublished = $onlyPublished;
    }

    public function onlyPublished():bool
    {
        return $this->onlyPublished;
    }
}

