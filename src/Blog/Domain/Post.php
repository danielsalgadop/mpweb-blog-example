<?php

namespace Blog\Domain;


use Blog\Domain\Exception\InvalidBodyException;
use Blog\Domain\Exception\InvalidTitleException;
use Blog\Domain\Exception\PostAlreadyPublishedException;

class Post
{
    private const MAX_TITLE_LENGTH = 30;

    private $id;
    private $title;
    private $body;
    private $isPublished;

    private function __construct(string $title, string $body, bool $isPublished)
    {
        $this->validateTitle($title);
        $this->validateBody($body);

        $this->title = filter_var($title, FILTER_SANITIZE_STRING);
        $this->body = filter_var($body, FILTER_SANITIZE_STRING);
        $this->isPublished = $isPublished;
    }

    public static function create(string $title, string $body):self
    {
        return new self($title, $body, false);
    }

    private function validateTitle(string $title):void
    {
        if ($title === '') throw InvalidTitleException::empty();

        $titleLength = mb_strlen($title);
        if ($titleLength > self::MAX_TITLE_LENGTH) throw InvalidTitleException::ofLength(
            $titleLength,
            self::MAX_TITLE_LENGTH
        );
    }

    private function validateBody(string $body):void
    {
        if ($body === '') throw InvalidBodyException::empty();
    }

    public function id():int
    {
        return $this->id;
    }

    public function title():string
    {
        return $this->title;
    }

    public function body():string
    {
        return $this->body;
    }

    public function isPublished():bool
    {
        return $this->isPublished;
    }

    public function toArray():array
    {
        return [
            'id'          => $this->id(),
            'title'       => $this->title(),
            'body'        => $this->body(),
            'isPublished' => $this->isPublished()
        ];
    }

    public function publish():void
    {
        if ($this->isPublished) {
            throw PostAlreadyPublishedException::withPostId($this->id());
        }
        $this->isPublished = true;
    }
}

