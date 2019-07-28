<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Controller;

use JournalMedia\Sample\Api\Journal\Service\ArticleServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;
use Zend\Diactoros\Response;

class ArticleController
{
    private $articleService;
    private $twig;

    public function __construct(ArticleServiceInterface $articleService, Environment $twig)
    {
        $this->articleService = $articleService;
        $this->twig = $twig;
    }

    public function getById(ServerRequestInterface $request, array $args): ResponseInterface
    {
        ['id' => $id] = $args;
        $article = $this->articleService->getArticleById((int) $id);

        $template = $this->twig->render('article/show.html.twig', ['article' => $article]);
        $response = new Response();
        $response->getBody()->write($template);

        return $response;
    }

    public function getByPublication(ServerRequestInterface $request, array $args): ResponseInterface
    {
        ['publication' => $publication] = $args;
        $articles = $this->articleService->getArticleByPublication($publication);

        $template = $this->twig->render('article/list.html.twig', ['articles' => $articles]);
        $response = new Response();
        $response->getBody()->write($template);
        return $response;
    }

    public function getByTag(ServerRequestInterface $request, array $args): ResponseInterface
    {
        ['tag' => $tag] = $args;
        $articles = $this->articleService->getArticleByPublication($tag);

        $template = $this->twig->render('article/list.html.twig', ['articles' => $articles]);
        $response = new Response();
        $response->getBody()->write($template);
        return $response;
    }
}