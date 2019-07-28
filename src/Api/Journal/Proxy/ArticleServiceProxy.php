<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Api\Journal\Proxy;


use JournalMedia\Sample\Api\Journal\Entity\Article;
use JournalMedia\Sample\Api\Journal\Serializer\ArticleSerializer;
use JournalMedia\Sample\Api\Journal\Service\ArticleServiceInterface;
use Predis\ClientInterface;

class ArticleServiceProxy implements ArticleServiceInterface
{
    private const PREFIX = 'journal.api.article';
    private $clientCache;
    private $articleSerializer;
    private $articleService;

    public function __construct(ClientInterface $clientCache, ArticleServiceInterface $articleService, ArticleSerializer $articleSerializer)
    {
        $this->clientCache = $clientCache;
        $this->articleSerializer = $articleSerializer;
        $this->articleService = $articleService;
    }

    public function getArticleById(int $id): Article
    {
        $nameCache = sprintf('%s.id.%d', self::PREFIX, $id);
        $cache = $this->clientCache->get($nameCache);

        if ($cache) {
            return $this->articleSerializer->toObject(json_decode($cache));
        }

        $article = $this->articleService->getArticleById($id);;

        $this->clientCache->set($nameCache,$this->articleSerializer->toJson($article));

        return $article;


    }

    public function getArticleByPublication(string $publication): array
    {
        $nameCache = sprintf('%s.publication.%s', self::PREFIX, $publication);
        $cache = $this->clientCache->get($nameCache);

        if ($cache) {
            return $this->articleSerializer->toObjects(json_decode($cache));
        }

        $articles = $this->articleService->getArticleByPublication($publication);;

        $this->clientCache->set($nameCache,$this->articleSerializer->toJson($articles));

        return $articles;
    }

    public function getArticleByTag(string $tag): array
    {
        $nameCache = sprintf('%s.tag.%s', self::PREFIX, $tag);
        $cache = $this->clientCache->get($nameCache);

        if ($cache) {
            return $this->articleSerializer->toObjects(json_decode($cache));
        }

        $articles = $this->articleService->getArticleByPublication($tag);;

        $this->clientCache->set($nameCache,$this->articleSerializer->toJson($articles));

        return $articles;
    }
}