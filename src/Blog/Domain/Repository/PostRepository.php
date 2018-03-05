<?php

namespace Blog\Domain\Repository;


use Blog\Domain\Post;

interface PostRepository
{
    public function save(Post $post):void;
}

