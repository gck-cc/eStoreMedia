<?php

declare(strict_types = 1);

namespace Core\Parser;

use Core\ValueObject\Product;
use Symfony\Component\DomCrawler\Crawler;

class DefaultParser implements Parser
{
    private const RATING_STAR = '★';
    private const MONEY_FORMAT = '$%D,%D';

    public function getProducts(string $html): array
    {
        $crawler = new Crawler($html);

        $products = $crawler->filter('.card')
            ->each(function (Crawler $node) {
                $name = $node->filter('.card-title a')->attr('data-name');
                $url = $node->filter('a')->attr('href');
                $imageUrl = $node->filter('.card-img-top')->attr('src');

                list($int, $dec) = sscanf($node->filter('.card-body h5')->text(), self::MONEY_FORMAT);
                $price = $int + $dec / 100;

                $stars = substr_count($node->filter('.card-footer')->html(), self::RATING_STAR);

                preg_match('/(\d+)/', $node->filter('.card-footer small')->html(), $data);
                $reviews = (int) $data[0];


                return new Product($name, $url, $price, $imageUrl, $stars, $reviews);
            });

        return array_filter($products);
    }

    public function getPages(string $html): array
    {
        $crawler = new Crawler($html);

        $pages = $crawler
            ->filter('.pagination li')
            ->each(function (Crawler $node) {
                $page = (int) $node->filter('a')->attr('data-page');

                return $page === (int) $node->filter('a')->text() ? $page : null;
            }
        );

        return array_filter($pages);
    }
}
