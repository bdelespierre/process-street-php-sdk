<?php

namespace ProcessStreet\Models;

/**
 * @phpstan-type UserData array{
 *     id: string,
 *     email: string,
 *     username: string
 * }
 */
class User
{
    public function __construct(
        public readonly string $id,
        public readonly string $email,
        public readonly string $username,
    ) {
    }

    /**
     * @param UserData $data
     */
    public static function from(array $data): self
    {
        return new self(
            id: $data['id'],
            email: $data['email'],
            username: $data['username'],
        );
    }
}
