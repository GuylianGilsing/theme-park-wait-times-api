<?php

declare(strict_types=1);

namespace App\Presentation\DTO;

use ErrorException;

final class ParksOverviewDTO
{
    private array $themeParks = [];
    private array $amusementParks = [];

    public function hasThemePark(string $key): bool
    {
        return isset($this->themeParks[$key]);
    }

    public function addThemePark(string $key, string $value): void
    {
        if ($this->hasThemePark($key))
        {
            throw new ErrorException("Theme park '".$key."' already exists within parks overview.");
        }

        $this->themeParks[$key] = $value;
    }

    /**
     * @return array<string, string>
     */
    public function getAllThemeParks(): array
    {
        return $this->themeParks;
    }

    public function hasAmusementPark(string $key): bool
    {
        return isset($this->amusementParks[$key]);
    }

    public function addAmusementPark(string $key, string $value): void
    {
        if ($this->hasAmusementPark($key))
        {
            throw new ErrorException("Amusement park '".$key."' already exists within parks overview.");
        }

        $this->amusementParks[$key] = $value;
    }

    /**
     * @return array<string, string>
     */
    public function getAllAmusementParks(): array
    {
        return $this->amusementParks;
    }
}
