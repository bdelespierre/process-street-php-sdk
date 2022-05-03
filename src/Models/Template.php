<?php

namespace ProcessStreet\Models;

/**
 * @phpstan-type TemplateData array{
 *     id: string,
 *     name: string
 * }
 */
class Template
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
    ) {
    }

    /**
     * @param TemplateData $data
     */
    public static function from(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
        );
    }
}
