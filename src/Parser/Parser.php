<?php

declare(strict_types = 1);

namespace Core\Parser;

use Core\ValueObject\Product;

interface Parser
{
    /**
     * @return array<Product>
     */
    public function getProducts(string $html): array;

    /**
     * @return array<int>
     */
    public function getPages(string $html): array;
}
