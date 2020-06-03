<?php

declare(strict_types = 1);

namespace Core\ValueObject;

final class Product
{
    private string $name;

    private string $url;

    private float $price;

    private string $imageUrl;

    private int $stars;

    private int $reviews;

    public function __construct(string $name, string $url, float $price, string $imageUrl, int $stars, int $reviews)
    {
        $this->name = $name;
        $this->url = $url;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->stars = $stars;
        $this->reviews = $reviews;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function price(): float
    {
        return $this->price;
    }

    public function imageUrl(): string
    {
        return $this->imageUrl;
    }

    public function stars(): int
    {
        return $this->stars;
    }

    public function reviews(): int
    {
        return $this->reviews;
    }
}
