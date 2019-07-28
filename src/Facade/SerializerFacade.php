<?php


namespace JournalMedia\Sample\Facade;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SerializerFacade
 * @package JournalMedia\Sample\Facade
 *
 * Sorry to do it.
 *
 * But I needed create this class because this library "illuminate/container" There is a bug...
 * When I try pass a array of object to Serializer class, It isn't pass object but It is passing as string.
 * e.g:
 * [normalizers:protected] => Array
 *   (
 *       [0] => Symfony\Component\Serializer\Normalizer\ObjectNormalizer
 *       [1] => Symfony\Component\Serializer\Normalizer\ArrayDenormalizer
 *   )
 */
class SerializerFacade extends Serializer
{
    public function __construct(ObjectNormalizer $objectNormalizer, ArrayDenormalizer $arrayDenormalizer, JsonEncoder $jsonEncoder)
    {
        parent::__construct([$objectNormalizer, $arrayDenormalizer], [$jsonEncoder]);
    }
}