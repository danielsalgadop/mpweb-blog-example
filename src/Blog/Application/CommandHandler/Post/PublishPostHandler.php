<?php

namespace Blog\Application\CommandHandler\Post;


use Blog\Application\Command\Post\PublishPostCommand;
use Blog\Domain\Post;
use Blog\Domain\Repository\PostRepository;

class PublishPostHandler
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function execute(PublishPostCommand $command):Post
    {
        $post = $this->postRepository->findPostByIdOrError($command->postId());
        $post->publish();
        $this->postRepository->update($post);
        return $post;
    }
}

