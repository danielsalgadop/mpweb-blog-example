<?php

namespace Blog\Domain\Exception;


use Throwable;

class UnknownPostException extends BadOperationException
{
    public $postId;

    private function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withPostId(int $id):self
    {
        $e = new static("Post with id [$id] doesn't exist");
        $e->postId = $id;
        return $e;
    }
}

