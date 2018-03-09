<?php

namespace Blog\Domain\Repository;


use Blog\Domain\Post;

interface PostRepository
{
    public function save(Post $post):void;
    public function update(Post $post):void;
    public function findPostByIdOrError(int $postId):Post;
}

