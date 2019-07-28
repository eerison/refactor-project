<?php
declare(strict_types=1);

namespace JournalMedia\Sample\Api\Journal\Service;

use JournalMedia\Sample\Api\Journal\Entity\Article;

interface ArticleServiceInterface
{
    public function getArticleById(int $id): Article;

    public function getArticleByPublication(string $publication): array;

    public function getArticleByTag(string $tag): array;
}