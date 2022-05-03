<?php

namespace ProcessStreet\Models;

use DateTimeInterface;
use DateTime;
use ProcessStreet\Enums\TaskStatus;

/**
 * @phpstan-import-type UserData from User
 * @phpstan-type TaskData array{
 *     id: string,
 *     name: string,
 *     completedDate: ?string,
 *     completedBy: ?UserData,
 *     updatedDate: string,
 *     updatedBy: UserData,
 *     status: string,
 *     stopped: bool,
 *     hidden: bool,
 *     taskTemplateGroupId: string,
 * }
 */
class Task
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?DateTimeInterface $completedAt,
        public readonly ?User $completedBy,
        public readonly DateTimeInterface $updatedAt,
        public readonly User $updatedBy,
        public readonly TaskStatus $status,
        public readonly bool $stopped,
        public readonly bool $hidden,
        public readonly string $taskTemplateGroupId,
    ) {
    }

    /**
     * @param TaskData $data
     */
    public static function from(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            completedAt: isset($data['completedDate']) ? new DateTime($data['completedDate']) : null,
            completedBy: isset($data['completedBy']) ? User::from($data['completedBy']) : null,
            updatedAt: new DateTime($data['updatedDate']),
            updatedBy: User::from($data['updatedBy']),
            status: TaskStatus::from($data['status']),
            stopped: (bool) $data['stopped'],
            hidden: (bool) $data['hidden'],
            taskTemplateGroupId: $data['taskTemplateGroupId'],
        );
    }
}
