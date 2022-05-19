<?php

declare(strict_types=1);

namespace App\Presentation\Views;

use App\Presentation\DTO\ParksOverviewDTO;

final class ParksOverviewView extends AbstractJSONView
{
    private ?ParksOverviewDTO $overviewDTO = null;

    public function __construct(ParksOverviewDTO $dto)
    {
        $this->overviewDTO = $dto;
    }

    /**
     * @return array<mixed>
     */
    protected function getViewData(): array
    {
        $json = [
            'themeParks' => [],
            'amusementParks' => [],
        ];

        if ($this->overviewDTO === null)
        {
            return $json;
        }

        $json['themeParks'] = $this->parksToObjectArray($this->overviewDTO->getAllThemeParks());
        $json['amusementParks'] = $this->parksToObjectArray($this->overviewDTO->getAllAmusementParks());

        return $json;
    }

    private function parksToObjectArray(array $assocArray): array
    {
        $objectArray = [];

        foreach ($assocArray as $key => $title)
        {
            $objectArray[] = [
                'key' => $key,
                'title' => $title,
            ];
        }

        return $objectArray;
    }
}
