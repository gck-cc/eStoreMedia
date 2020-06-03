<?php

declare(strict_types = 1);

namespace Core\Page;

final class EStoreMediaPage implements Page
{
    private const URL = 'http://estoremedia.space/DataIT/index.php?page=';

    private int $page = 1;

    public function getUrl(): string
    {
        return self::URL . $this->page;
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }
}
