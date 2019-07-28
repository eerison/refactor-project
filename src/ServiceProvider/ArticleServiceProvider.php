<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ServiceProvider;

use JournalMedia\Sample\Api\Journal\Proxy\ArticleServiceProxy;
use JournalMedia\Sample\Api\Journal\Serializer\ArticleSerializer;
use JournalMedia\Sample\Api\Journal\Serializer\TagSerializer;
use JournalMedia\Sample\Api\Journal\Service\ArticleService;
use JournalMedia\Sample\Controller\ArticleController;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ArticleServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        ArticleController::class,
        ArticleService::class,
        ArticleServiceProxy::class,
        ArticleSerializer::class,
    ];

    public function register()
    {
        $this->getContainer()
                ->add(ArticleController::class)
                ->addArgument(ArticleServiceProxy::class)
                ->addArgument('twig');

        $this->getContainer()
            ->add(ArticleServiceProxy::class)
            ->addArgument('cache.redis')
            ->addArgument(ArticleService::class)
            ->addArgument(ArticleSerializer::class);

        $this->getContainer()
                ->add(ArticleService::class)
                ->addArgument('client_http.journal')
                ->addArgument(ArticleSerializer::class);

        $this->getContainer()
                ->add(ArticleSerializer::class)
                ->addArgument('serializer')
                ->addArgument(TagSerializer::class);
    }
}