<?php
declare(strict_types=1);

$container = new League\Container\Container();

$container->addServiceProvider(\JournalMedia\Sample\ServiceProvider\SerializerServiceProvider::class);
$container->addServiceProvider(\JournalMedia\Sample\ServiceProvider\ClientHttpServiceProvider::class);
$container->addServiceProvider(\JournalMedia\Sample\ServiceProvider\TwigServiceProvider::class);
$container->addServiceProvider(\JournalMedia\Sample\ServiceProvider\CacheServiceProvider::class);
$container->addServiceProvider(\JournalMedia\Sample\ServiceProvider\ArticleServiceProvider::class);
$container->addServiceProvider(\JournalMedia\Sample\ServiceProvider\TagServiceProvider::class);
