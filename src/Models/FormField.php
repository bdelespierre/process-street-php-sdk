<?php

namespace ProcessStreet\Models;

use DateTime;
use DateTimeInterface;
use ProcessStreet\Enums\FormFieldType;
use ProcessStreet\Models\FormFields\DateFormField;
use ProcessStreet\Models\FormFields\FileFormField;
use ProcessStreet\Models\FormFields\MultiFormField;
use ProcessStreet\Models\FormFields\TextFormField;

/**
 * @phpstan-import-type UserData from User
 * @phpstan-type FormFieldData array{
 *   id: string,
 *   hidden: bool,
 *   updatedDate: string,
 *   updatedBy: UserData,
 *   label: string,
 *   type: string,
 *   value: ?string,
 * }
 */
abstract class FormField
{
    final public function __construct(
        public readonly string $id,
        public readonly bool $hidden,
        public readonly DateTimeInterface $updatedAt,
        public readonly User $updatedBy,
        public readonly string $label,
        public readonly FormFieldType $type,
        public readonly ?string $rawValue,
    ) {
    }

    /**
     * @param FormFieldData $data
     */
    public static function from(array $data): self
    {
        $class = match ($data['type']) {
            FormFieldType::MULTISELECT->value, FormFieldType::MULTICHOICE->value => MultiFormField::class,
            FormFieldType::FILE->value => FileFormField::class,
            FormFieldType::DATE->value => DateFormField::class,
            default => TextFormField::class,
        };

        return new $class(
            id: $data['id'],
            hidden: (bool) $data['hidden'],
            updatedAt: new DateTime($data['updatedDate']),
            updatedBy: User::from($data['updatedBy']),
            label: $data['label'],
            type: FormFieldType::from($data['type']),
            rawValue: $data['value'] ?? null,
        );
    }
}
