<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Api\Journal\Service;

use GuzzleHttp\ClientInterface;
use JournalMedia\Sample\Api\Journal\Entity\Article;
use JournalMedia\Sample\Api\Journal\Serializer\ArticleSerializer;

class ArticleService implements ArticleServiceInterface
{
    private $httpClient;
    private $articleSerializer;

    public function __construct(ClientInterface $httpClient, ArticleSerializer $articleSerializer)
    {
        $this->httpClient = $httpClient;
        $this->articleSerializer = $articleSerializer;
    }

    public function getArticleById(int $id): Article
    {
        $client = $this->httpClient->get(sprintf('v3/article/%d', $id));
        $content = json_decode($client->getBody()->getContents());
        [$pageItems] = $content->response->page_items;
        return $this->articleSerializer->toObject($pageItems);
    }

    public function getArticleByPublication(string $publication): array
    {
        $client = $this->httpClient->get(sprintf('v3/sample/%s', $publication));
        $content = json_decode($client->getBody()->getContents());
        return $this->articleSerializer->toObjects($content->response->articles);
    }

    public function getArticleByTag(string $tag): array
    {
        $client = $this->httpClient->get(sprintf('v3/sample/tag/%s', $tag));
        $content = json_decode($client->getBody()->getContents());
        return $this->articleSerializer->toObjects($content->response->articles);
    }
}