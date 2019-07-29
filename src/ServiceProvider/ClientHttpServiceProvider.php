<?php
declare(strict_types=1);

namespace JournalMedia\Sample\ServiceProvider;

use GuzzleHttp\Client;
use League\Container\ServiceProvider\AbstractServiceProvider;

class ClientHttpServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        'client_http.journal',
    ];

    public function register()
    {
        $this->getContainer()
            ->add('client_http.journal', Client::class)
            ->addArgument([
                'base_uri' => getenv('API_JOURNAL_HOST'),
                'headers' => ['content-type' => 'application/json'],
                'auth' => [getenv('API_JOURNAL_AUTH_USER'), getenv('API_JOURNAL_AUTH_PASSWORD')]
            ]);
    }
}