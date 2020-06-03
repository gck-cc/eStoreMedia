<?php

declare(strict_types = 1);

namespace Core\Service;

use Core\Builder\CsvBuilder;
use Core\HttpClient\HttpClient;
use Core\Page\Page;
use Core\Parser\Parser;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Task1
{
    private HttpClient $httpClient;

    private Page $page;

    private Parser $parser;

    public function __construct(HttpClient $httpClient, Page $page, Parser $parser)
    {
        $this->httpClient = $httpClient;
        $this->page = $page;
        $this->parser = $parser;
    }

    public function getPageHtml(int $page = null): string
    {
        if ($page) {
            $this->page->setPage($page);
        }

        return $this->httpClient->get($this->page->getUrl());
    }

    public function exportToCsv(string $path, array $products): void
    {
        $spreadsheet = new CsvBuilder(...$products);

        $writer = new Csv($spreadsheet->buildSpreadsheet());
        $writer->save($path);
    }

    public function run(string $path): void
    {
        $html = $this->getPageHtml();
        $pages = $this->parser->getPages($html);
        $products = [];

        foreach ($pages as $page) {
            $products[] = $this->parser->getProducts($this->getPageHtml($page));
        }

        $products = array_merge(...$products);

        $this->exportToCsv($path, $products);

        echo "\n\nProducts exported.\n\n";
    }
}
