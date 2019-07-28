<?php


namespace JournalMedia\Sample\ServiceProvider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'twig',
    ];

    public function register()
    {
        $this->getContainer()
            ->add('twig', Environment::class)
            ->addArgument(FilesystemLoader::class)
            ->addArgument(['cache' => 'bin/cache', 'debug' => true]);

        $this->getContainer()
            ->add(FilesystemLoader::class)
            ->addArgument('src/View');
    }
}