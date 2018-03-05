<?php

namespace Blog\Domain\Exception;


class InvalidTitleException extends InvalidArgumentException
{
    public $titleLength;

    public static function ofLength(int $length, int $maxLength):self
    {
        $exception = new static("Invalid length [$length] for the title, max length is $maxLength");
        $exception->titleLength = $length;
        return $exception;
    }

    public static function empty()
    {
        return new static("The title must be specified");
    }
}

