<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ServiceProvider;


use League\Container\ServiceProvider\AbstractServiceProvider;
use Predis\Client;

class CacheServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
       'cache.redis'
    ];

    public function register()
    {
        $this->getContainer()
            ->add('cache.redis', Client::class)
            ->addArgument(getenv('CACHE_REDIS_HOST'));
    }
}