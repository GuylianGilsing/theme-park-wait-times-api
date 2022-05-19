<?php

declare(strict_types=1);

namespace Framework\Markers;

interface JSONSerializableInterface
{
    public function toJSON(): string;
}
