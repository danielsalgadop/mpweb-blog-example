<?php

namespace BlogBundle\Repository;


use Blog\Domain\Exception\RepositoryException;
use Blog\Domain\Exception\UnknownPostException;
use Blog\Domain\Post;
use Blog\Domain\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class MySQLPostRepository implements PostRepository
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function save(Post $post):void
    {
        try {
            $this->em->persist($post);
        } catch (Exception $e) {
            throw RepositoryException::withError($e);
        }
    }

    public function update(Post $post):void
    {
        $this->save($post);
    }

    public function findPostByIdOrError(int $postId):Post
    {
        $posts = $this->em
            ->getRepository('BlogBundle:Post')
            ->findBy(['id' => $postId]);
        if (count($posts) === 0) {
            throw UnknownPostException::withPostId($postId);
        }
        return $posts[0];
    }
}

