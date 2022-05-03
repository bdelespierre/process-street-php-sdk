<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ProcessStreet\Enums\PayloadType;
use ProcessStreet\Enums\TaskStatus;
use ProcessStreet\Models\Checklist;
use ProcessStreet\Models\Payload;
use ProcessStreet\Models\Task;
use ProcessStreet\Models\Template;
use ProcessStreet\Models\User;

/**
 * @phpstan-import-type PayloadData from Payload
 */
class ChecklistCreatedTest extends TestCase
{
    public function testPayload(): Checklist
    {
        /** @var string $contents */
        $contents = file_get_contents(
            './tests/Data/ChecklistCreated.json'
        );

        /** @var PayloadData $data */
        $data = json_decode(
            json: $contents,
            associative: true
        );

        $model = Payload::from($data);

        $this->assertEquals(
            'pHnWErntCr9LXvkZ5AROYg',
            $model->id,
        );

        $this->assertSame(
            PayloadType::CHECKLIST_CREATED,
            $model->type,
        );

        $this->assertEquals(
            '2022-03-29T16:22:29+00:00',
            $model->createdAt->format(\DateTimeInterface::ATOM),
        );

        return $model->checklist;
    }

    /**
     * @depends testPayload
     */
    public function testChecklist(Checklist $model): void
    {
        $this->assertEquals(
            'ocEMmTpockp6e8Aw9EhIRg',
            $model->id,
        );

        $this->assertEquals(
            "6:22PM workflow run",
            $model->name,
        );

        $this->assertEquals(
            "2022-03-29T16:22:28+00:00",
            $model->createdAt->format(\DateTimeInterface::ATOM),
        );

        $this->assertEquals(
            new User(
                id: 'jYjECYhmNZVxXVLMgDFJ8A',
                email: 'john.doe@example.com',
                username: 'John Doe',
            ),
            $model->createdBy,
        );

        $this->assertEquals(
            '2022-03-29T16:22:28+00:00',
            $model->updatedAt->format(\DateTimeInterface::ATOM),
        );

        $this->assertEquals(
            new User(
                id: 'jYjECYhmNZVxXVLMgDFJ8A',
                email: 'john.doe@example.com',
                username: 'John Doe',
            ),
            $model->updatedBy,
        );

        $this->assertNull(
            $model->completedAt,
        );

        $this->assertNull(
            $model->completedBy,
        );

        $this->assertEquals(
            new Template(
                id: 'vPcdWhxatMZIbYFlgyhDWQ',
                name: 'Test Workflow',
            ),
            $model->template,
        );

        $this->assertEmpty(
            $model->formFields,
        );
    }

    /**
     * @depends testPayload
     */
    public function testTasks(Checklist $model): void
    {
        $this->assertCount(1, $model->tasks);

        $this->assertEquals(
            new Task(
                id: 'uj_SAfMmrkCBnUwbG11PHg',
                name: 'Test Task #1',
                completedAt: null,
                completedBy: null,
                updatedAt: new \DateTime('2022-03-29T16:22:28.898000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                status: TaskStatus::NOT_COMPLETED,
                stopped: false,
                hidden: false,
                taskTemplateGroupId: 'uIEm_NK44a_g4ugvqphA3Q',
            ),
            $model->tasks[0],
        );
    }
}
