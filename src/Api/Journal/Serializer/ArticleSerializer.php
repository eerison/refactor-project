<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Api\Journal\Serializer;

use Symfony\Component\Serializer\Serializer;
use \JournalMedia\Sample\Api;

class ArticleSerializer
{
    private $serializer;
    private $tagSerializer;
    private const FORMAT_JSON = 'json';

    public function __construct(Serializer $serializer, TagSerializer $tagSerializer)
    {
        $this->serializer = $serializer;
        $this->tagSerializer = $tagSerializer;
    }

    public function toObject($jsonData): Api\Journal\Entity\Article
    {
        $tags = $this->tagSerializer->toObjects($jsonData->tags);

        /** @var Api\Journal\Entity\Article $article */
        $article =  $this->serializer->deserialize(
            json_encode($jsonData),
            Api\Journal\Entity\Article::class,
            self::FORMAT_JSON,
            ['ignored_attributes' => ['tags']]
        );
        $article->setTags($tags);

        return $article;
    }

    public function toObjects($jsonData): array
    {
        $articles = [];

        foreach ($jsonData as $articleJson)
        {
            array_push($articles, $this->toObject($articleJson));
        }

        return $articles;
    }

    public function toJson($article)
    {
        return $this->serializer->serialize($article, self::FORMAT_JSON);
    }
}