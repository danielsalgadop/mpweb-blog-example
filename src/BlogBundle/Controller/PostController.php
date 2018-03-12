<?php

namespace BlogBundle\Controller;


use Blog\Application\Command\Post\CreatePostCommand;
use Blog\Application\Command\Post\FindPostsCommand;
use Blog\Application\Command\Post\PublishPostCommand;
use Blog\Domain\Exception\BadOperationException;
use Blog\Domain\Exception\InvalidArgumentException;
use Blog\Domain\Exception\RepositoryException;
use Blog\Domain\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    public function createPostAction(Request $request):JsonResponse
    {
        $jsonRequestBody = json_decode($request->getContent(), true);

        $title = filter_var($jsonRequestBody['title'] ?? '', FILTER_SANITIZE_STRING);
        $body = filter_var($jsonRequestBody['body'] ?? '', FILTER_SANITIZE_STRING);

        $command = new CreatePostCommand($title, $body);
        $handler = $this->get('blog.command_handler.create_post');

        try {
            $post = $handler->handle($command);
            $this->end();
            return new JsonResponse(
                ['success' => 'Post correctly created', 'post' => $post->toArray()],
                200
            );
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (RepositoryException $e) {
            return new JsonResponse(['error' => 'An application error has occurred'], 500);
        }
    }

    public function publishPostAction(int $postId):JsonResponse
    {
        $command = new PublishPostCommand($postId);
        $handler = $this->get('blog.command_handler.publish_post');

        try {
            $post = $handler->execute($command);
            $this->end();
            return new JsonResponse(
                ['success' => 'Post published correctly', 'post' => $post->toArray()],
                200
            );
        } catch (BadOperationException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (RepositoryException $e) {
            return new JsonResponse(['error' => 'An application error has occurred'], 500);
        }
    }

    public function findPostsAction(Request $request):JsonResponse
    {
        $command = new FindPostsCommand(
            filter_var($request->query->get('onlyPublished', false), FILTER_VALIDATE_BOOLEAN)
        );
        $handler = $this->get('blog.command_handler.find_posts');

        try {
            $posts = $handler->execute($command);
            $posts = array_map(function (Post $post) { return $post->toArray(); }, $posts);

            return new JsonResponse(['items' => $posts], 200);
        } catch (RepositoryException $e) {
            return new JsonResponse(['error' => 'An application error has occurred'], 500);
        }
    }

    private function end()
    {
        $this->get('doctrine.orm.default_entity_manager')->flush();
    }
}

