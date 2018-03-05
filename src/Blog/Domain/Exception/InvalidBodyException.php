<?php

namespace Blog\Domain\Exception;


class InvalidBodyException extends InvalidArgumentException
{
    public static function empty()
    {
        return new static("The body must be specified");
    }
}

