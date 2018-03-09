<?php

namespace Blog\Domain\Exception;


use Throwable;

class PostAlreadyPublishedException extends BadOperationException
{
    public $postId;

    private function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withPostId(int $id):self
    {
        $e = new static("Post with id [$id] already published");
        $e->postId = $id;
        return $e;
    }
}

