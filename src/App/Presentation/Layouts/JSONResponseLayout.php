<?php

declare(strict_types=1);

namespace App\Presentation\Layouts;

use Framework\Markers\JSONSerializableInterface;

final class JSONResponseLayout implements JSONSerializableInterface
{
    /**
     * @var array<mixed> $data
     */
    private array $data = [];

    /**
     * @param array<mixed> $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function toJSON(): string
    {
        $payload = [
            'time' => time(),
            'data' => $this->data,
        ];

        return json_encode($payload, JSON_OBJECT_AS_ARRAY);
    }
}
