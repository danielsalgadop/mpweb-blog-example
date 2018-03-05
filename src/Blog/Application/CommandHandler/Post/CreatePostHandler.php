<?php

namespace Blog\Application\CommandHandler\Post;


use Blog\Application\Command\Post\CreatePostCommand;
use Blog\Domain\Post;
use Blog\Domain\Repository\PostRepository;

class CreatePostHandler
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(CreatePostCommand $command):Post
    {
        $post = Post::create($command->title(), $command->body());
        $this->postRepository->save($post);
        return $post;
    }
}

