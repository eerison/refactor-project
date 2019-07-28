<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ServiceProvider;

use JournalMedia\Sample\Api\Journal\Serializer\TagSerializer;
use League\Container\ServiceProvider\AbstractServiceProvider;

class TagServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        TagSerializer::class,
    ];

    public function register()
    {
        $this->getContainer()
            ->add(TagSerializer::class)
            ->addArgument('serializer');
    }
}