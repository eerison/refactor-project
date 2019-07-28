<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ServiceProvider;

use JournalMedia\Sample\Facade\SerializerFacade;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SerializerServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'serializer',
    ];

    public function register()
    {

        $this->getContainer()
            ->add('serializer', SerializerFacade::class)
            ->addArgument(ObjectNormalizer::class)
            ->addArgument(ArrayDenormalizer::class)
            ->addArgument(JsonEncoder::class);

        $this->getContainer()->add(ObjectNormalizer::class);
        $this->getContainer()->add(ArrayDenormalizer::class);
        $this->getContainer()->add(JsonEncoder::class);
    }
}