<?php

namespace ProcessStreet\Models;

use DateTimeInterface;
use DateTime;
use ProcessStreet\Enums\PayloadType;

/**
 * @phpstan-import-type ChecklistData from Checklist
 * @phpstan-type PayloadData array{
 *     id: string,
 *     type: string,
 *     createdDate: string,
 *     data: ChecklistData,
 * }
 */
class Payload
{
    public function __construct(
        public readonly string $id,
        public readonly PayloadType $type,
        public readonly DateTimeInterface $createdAt,
        public readonly Checklist $checklist,
    ) {
    }

    /**
     * @param PayloadData $data
     */
    public static function from(array $data): self
    {
        return new self(
            id: $data['id'],
            type: PayloadType::from($data['type']),
            createdAt: new DateTime($data['createdDate']),
            checklist: Checklist::from($data['data']),
        );
    }
}
