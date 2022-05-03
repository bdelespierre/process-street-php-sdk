<?php

namespace ProcessStreet\Models;

use DateTimeInterface;
use DateTime;

/**
 * @phpstan-import-type UserData from User
 * @phpstan-import-type TemplateData from Template
 * @phpstan-import-type FormFieldData from FormField
 * @phpstan-import-type TaskData from Task
 * @phpstan-type ChecklistData array{
 *     id: string,
 *     name: string,
 *     audit: array{
 *         createdDate: string,
 *         createdBy: UserData,
 *         updatedDate: string,
 *         updatedBy: UserData,
 *     },
 *     completedDate: ?string,
 *     completedBy: ?UserData,
 *     template: TemplateData,
 *     formFields: array<FormFieldData>,
 *     tasks: array<TaskData>,
 * }
 */
class Checklist
{
    /**
     * @param array<FormField> $formFields
     * @param array<Task> $tasks
     */
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly DateTimeInterface $createdAt,
        public readonly User $createdBy,
        public readonly DateTimeInterface $updatedAt,
        public readonly User $updatedBy,
        public readonly ?DateTimeInterface $completedAt,
        public readonly ?User $completedBy,
        public readonly Template $template,
        public readonly array $formFields,
        public readonly array $tasks,
    ) {
    }

    /**
     * @param ChecklistData $data
     */
    public static function from(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            createdAt: new DateTime($data['audit']['createdDate']),
            createdBy: User::from($data['audit']['createdBy']),
            updatedAt: new DateTime($data['audit']['updatedDate']),
            updatedBy: User::from($data['audit']['updatedBy']),
            completedAt: isset($data['completedDate']) ? new DateTime($data['completedDate']) : null,
            completedBy: isset($data['completedBy']) ? User::from($data['completedBy']) : null,
            template: Template::from($data['template']),
            formFields: array_map([FormField::class, 'from'], $data['formFields']),
            tasks: array_map([Task::class, 'from'], $data['tasks']),
        );
    }
}
