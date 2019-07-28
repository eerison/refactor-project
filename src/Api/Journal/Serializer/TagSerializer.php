<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Api\Journal\Serializer;


use JournalMedia\Sample\Api\Journal\Entity\Tag;
use Symfony\Component\Serializer\Serializer;

class TagSerializer
{
    private $serializer;
    private const FORMAT_JSON = 'json';

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function toObjects($tagsData)
    {
        return $this->serializer->deserialize(json_encode($tagsData),  Tag::class . '[]', self::FORMAT_JSON);
    }
}