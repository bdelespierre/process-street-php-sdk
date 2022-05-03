<?php

namespace ProcessStreet\Models;

class File
{
    public function __construct(
        public readonly string $url
    ) {
    }

    public function getContents(): string|false
    {
        return file_get_contents($this->url);
    }
}
