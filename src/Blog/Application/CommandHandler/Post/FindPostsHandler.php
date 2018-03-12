<?php

namespace Blog\Application\CommandHandler\Post;


use Blog\Application\Command\Post\FindPostsCommand;
use Blog\Domain\Repository\PostRepository;

class FindPostsHandler
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(FindPostsCommand $command):array
    {
        if ($command->onlyPublished()) return $this->postRepository->findAllPublishedPosts();
        else return $this->postRepository->findAllPosts();
    }
}

