<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Helper\Test;

use JournalMedia\Sample\Api;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArticleSerializerTest extends TestCase
{
    public function testSerializerOneArticleJsonToArticleObject()
    {
        $data = (object)[
            'id' => 4742704,
            "title" => "Scottish man who faked own death in US to avoid rape charges has been arrested",
            "excerpt" => "He is being held by the US Marshals Service.",
            "type" => "post",
            "content" => "<p>A SCOTTISH MAN who authorities say faked his death in the US to avoid rape charges back home has been arrested.</p>\n<p>Kim Vincent Avis (55), also known as Ken Gordon-Avis, was arrested in Colorado Springs, Colorado, last week. He is being held by the US Marshals Service",
            "tags" => [
                (object)['slug' => '01']
            ],
        ];

        $serializer = new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]);
        $articleSerializer = new Api\Journal\Serializer\ArticleSerializer($serializer, new Api\Journal\Serializer\TagSerializer($serializer));
        $article = $articleSerializer->toObject($data);

        $this->assertInstanceOf(Api\Journal\Entity\Article::class, $article);
        $this->assertEquals($serializer->serialize($article, 'json'), json_encode($data));
    }

    public function testSerializerListArticleJsonToArticleObjects()
    {
        $data = [
            (object)[
                'id' => 4742704,
                "title" => "Scottish man who faked own death in US to avoid rape charges has been arrested",
                "excerpt" => "He is being held by the US Marshals Service.",
                "type" => "post",
                "content" => "<p>A SCOTTISH MAN who authorities say faked his death in the US to avoid rape charges back home has been arrested.</p>\n<p>Kim Vincent Avis (55), also known as Ken Gordon-Avis, was arrested in Colorado Springs, Colorado, last week. He is being held by the US Marshals Service",
                "tags" => [
                    (object)['slug' => '01']
                ],
            ]
        ];

        $serializer = new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]);
        $articleSerializer = new Api\Journal\Serializer\ArticleSerializer($serializer, new Api\Journal\Serializer\TagSerializer($serializer));
        $article = $articleSerializer->toObjects($data);

        $this->assertEquals($serializer->serialize($article, 'json'), json_encode($data));
    }
}