<?php

declare(strict_types = 1);

namespace Core\Parser;

interface Parser
{
    public function getProducts(string $html): array;

    public function getPages(string $html): array;
}
