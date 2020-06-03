<?php

declare(strict_types = 1);

namespace Core\Builder;

use Core\ValueObject\Product;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CsvBuilder
{
    private const HEADERS = ['Nazwa produktu', 'URL', 'URL zdjęcia', 'Cena', 'Liczba ocen', 'Liczba gwiazdek'];

    /** @var array<Product> */
    private array $products = [];

    private Spreadsheet $spreadsheet;

    public function __construct(Product ...$products)
    {
        $this->products = $products;
        $this->spreadsheet = new Spreadsheet();
    }

    public function buildSpreadsheet(): Spreadsheet
    {
        $this->spreadsheet = $this->addHeaders($this->spreadsheet);
        $this->spreadsheet = $this->addProducts($this->spreadsheet);

        return $this->spreadsheet;
    }

    private function addHeaders(Spreadsheet $spreadsheet, int $row = 1): Spreadsheet
    {
        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, self::HEADERS[0])
            ->setCellValue('B' . $row, self::HEADERS[1])
            ->setCellValue('C' . $row, self::HEADERS[2])
            ->setCellValue('D' . $row, self::HEADERS[3])
            ->setCellValue('E' . $row, self::HEADERS[4])
            ->setCellValue('F' . $row, self::HEADERS[5]);

        return $spreadsheet;
    }

    private function addProducts(Spreadsheet $spreadsheet, int $row = 2): Spreadsheet
    {
        foreach ($this->products as $product) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $row, $product->name())
                ->setCellValue('B' . $row, $product->url())
                ->setCellValue('C' . $row, $product->imageUrl())
                ->setCellValue('D' . $row, $product->price())
                ->setCellValue('E' . $row, $product->reviews())
                ->setCellValue('F' . $row, $product->stars());

            $row++;
        }

        return $spreadsheet;
    }
}
