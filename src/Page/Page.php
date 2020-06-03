<?php

declare(strict_types = 1);

namespace Core\Page;

interface Page
{
    public function setPage(int $page): void;

    public function getUrl(): string;
}
