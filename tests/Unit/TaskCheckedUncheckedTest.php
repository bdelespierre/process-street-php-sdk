<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ProcessStreet\Enums\FormFieldType;
use ProcessStreet\Enums\PayloadType;
use ProcessStreet\Enums\TaskStatus;
use ProcessStreet\Models\Checklist;
use ProcessStreet\Models\File;
use ProcessStreet\Models\FormFields\DateFormField;
use ProcessStreet\Models\FormFields\FileFormField;
use ProcessStreet\Models\FormFields\MultiFormField;
use ProcessStreet\Models\FormFields\TextFormField;
use ProcessStreet\Models\Payload;
use ProcessStreet\Models\Task;
use ProcessStreet\Models\Template;
use ProcessStreet\Models\User;

/**
 * @phpstan-import-type PayloadData from Payload
 */
class TaskCheckedUncheckedTest extends TestCase
{
    public function testPayload(): Checklist
    {
        /** @var string $contents */
        $contents = file_get_contents(
            './tests/Data/TaskCheckedUnchecked.json'
        );

        /** @var PayloadData $data */
        $data = json_decode(
            json: $contents,
            associative: true
        );

        $model = Payload::from($data);

        $this->assertEquals(
            'gUDBwXc5vrgfGe33ZQlOUA',
            $model->id,
        );

        $this->assertEquals(
            PayloadType::CHECKLIST_COMPLETED,
            $model->type,
        );

        $this->assertEquals(
            '2022-03-29T20:31:02+00:00',
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
            'lDxvV2GzDNLMXypfuJZKKA',
            $model->id,
        );

        $this->assertEquals(
            'Workflow Run',
            $model->name,
        );

        $this->assertEquals(
            '2022-03-29T16:30:14+00:00',
            $model->createdAt->format(\DateTimeInterface::ATOM),
        );

        $this->assertEquals(
            new User(
                id: "jYjECYhmNZVxXVLMgDFJ8A",
                email: "john.doe@example.com",
                username: "John Doe",
            ),
            $model->createdBy,
        );

        $this->assertEquals(
            '2022-03-29T20:31:02+00:00',
            $model->updatedAt->format(\DateTimeInterface::ATOM),
        );

        $this->assertEquals(
            new User(
                id: "jYjECYhmNZVxXVLMgDFJ8A",
                email: "john.doe@example.com",
                username: "John Doe",
            ),
            $model->updatedBy,
        );

        assert(isset($model->completedAt));
        $this->assertEquals(
            '2022-03-29T20:31:02+00:00',
            $model->completedAt->format(\DateTimeInterface::ATOM),
        );

        assert(isset($model->completedBy));
        $this->assertEquals(
            new User(
                id: "jYjECYhmNZVxXVLMgDFJ8A",
                email: "john.doe@example.com",
                username: "John Doe",
            ),
            $model->completedBy,
        );

        $this->assertEquals(
            new Template(
                id: "vPcdWhxatMZIbYFlgyhDWQ",
                name: "Test Workflow",
            ),
            $model->template,
        );
    }

    /**
     * @depends testPayload
     */
    public function testFormFields(Checklist $model): void
    {
        $this->assertCount(11, $model->formFields);

        $this->assertEquals(
            new MultiFormField(
                id: 'tz5Co8Smv3lC8VET4EdF3Q',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:28:20.846000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'multi_select_field',
                type: FormFieldType::MULTISELECT,
                rawValue: 'Subtask #1, Subtask #2, Subtask #3',
            ),
            $model->formFields[0],
        );

        assert($model->formFields[0] instanceof MultiFormField);
        $this->assertEquals(
            ['Subtask #1', 'Subtask #2', 'Subtask #3'],
            $model->formFields[0]->getValue(),
        );

        $this->assertEquals(
            new TextFormField(
                id: 'mCRKpO6m2f-CFXK2LB9Jng',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:29:56.175000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Short Text Label',
                type: FormFieldType::TEXT,
                rawValue: 'Short Text Value',
            ),
            $model->formFields[1],
        );

        assert($model->formFields[1] instanceof TextFormField);
        $this->assertEquals(
            'Short Text Value',
            $model->formFields[1]->getValue(),
        );

        $this->assertEquals(
            new TextFormField(
                id: 'qY8cIlt4K7EYxCcSIUNGLQ',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:03.418000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Long Text Label',
                type: FormFieldType::TEXTAREA,
                rawValue: 'Long Text Label',
            ),
            $model->formFields[2],
        );

        $this->assertEquals(
            new TextFormField(
                id: 'pSK8GJA9EiiuacRAF1dDtw',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:15.494000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Email Label',
                type: FormFieldType::EMAIL,
                rawValue: 'john.doe@example.com',
            ),
            $model->formFields[3],
        );

        $this->assertEquals(
            new TextFormField(
                id: 'hhNJyKMeb8ofrymK1nFLUw',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:20.617000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Website Label',
                type: FormFieldType::URL,
                rawValue: 'http://example.com',
            ),
            $model->formFields[4],
        );

        $this->assertEquals(
            new FileFormField(
                id: 'lj5Ln7FLl7o9ffmky9FI6g',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:25.491000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'File Upload Label',
                type: FormFieldType::FILE,
                rawValue: 'tests/Data/TaskCheckedUncheckedFile.txt',
            ),
            $model->formFields[5],
        );

        assert($model->formFields[5] instanceof FileFormField);
        $this->assertEquals(
            new File('tests/Data/TaskCheckedUncheckedFile.txt'),
            $model->formFields[5]->getValue(),
        );

        assert($model->formFields[5]->getValue() instanceof File);
        $this->assertEquals(
            "File content\n",
            $model->formFields[5]->getValue()->getContents(),
        );

        $this->assertEquals(
            new DateFormField(
                id: 'hVHKQjI4Wyu8Q1BRFaFE-Q',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:32.393000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Date Label',
                type: FormFieldType::DATE,
                rawValue: '2022-03-30T15:00:00.000Z',
            ),
            $model->formFields[6],
        );

        assert($model->formFields[6] instanceof DateFormField);
        $this->assertEquals(
            new \DateTime('2022-03-30T15:00:00.000000+0000'),
            $model->formFields[6]->getValue(),
        );

        $this->assertEquals(
            new TextFormField(
                id: 'lViaNUuMeJkOi4SmqRJLmA',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:42.156000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Numbers Label',
                type: FormFieldType::NUMBER,
                rawValue: '123',
            ),
            $model->formFields[7],
        );

        $this->assertEquals(
            new TextFormField(
                id: 'mCd_mVm-6hReSINZralF9A',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:45.576000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Dropdown Label',
                type: FormFieldType::SELECT,
                rawValue: 'Option #2',
            ),
            $model->formFields[8],
        );

        $this->assertEquals(
            new MultiFormField(
                id: 'nwYCbIuUiZcy4h2YT6xFsg',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:30:47.796000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Multichoice Label',
                type: FormFieldType::MULTICHOICE,
                rawValue: 'Option #5, Option #4',
            ),
            $model->formFields[9],
        );

        assert($model->formFields[9] instanceof MultiFormField);
        $this->assertEquals(
            ['Option #5', 'Option #4'],
            $model->formFields[9]->getValue(),
        );

        $this->assertEquals(
            new TextFormField(
                id: 'qjbnGlXPtRjVYzOpe85BLA',
                hidden: false,
                updatedAt: new \DateTime('2022-03-29T20:31:01.863000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                label: 'Members Label',
                type: FormFieldType::MEMBERS,
                rawValue: 'john.doe@example.com',
            ),
            $model->formFields[10],
        );
    }

    /**
     * @depends testPayload
     * @covers \ProcessStreet\Models\Task
     * @covers \ProcessStreet\Models\User
     * @covers \ProcessStreet\Enums\TaskStatus
     */
    public function testTasks(Checklist $model): void
    {
        $this->assertCount(3, $model->tasks);

        $this->assertEquals(
            new Task(
                id: 'rOHrIgI2zHyFEeDukNdNzg',
                name: 'Test Task #1',
                completedAt: new \DateTime('2022-03-29T20:23:41.433000+0000'),
                completedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                updatedAt: new \DateTime('2022-03-29T20:23:41.413000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                status: TaskStatus::COMPLETED,
                stopped: false,
                hidden: false,
                taskTemplateGroupId: 'uIEm_NK44a_g4ugvqphA3Q',
            ),
            $model->tasks[0],
        );

        $this->assertEquals(
            new Task(
                id: 'kT-6uzRFip-hfWMtV5tDTQ',
                name: 'Test Task #2',
                completedAt: new \DateTime('2022-03-29T20:28:21.460000+0000'),
                completedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                updatedAt: new \DateTime('2022-03-29T20:28:21.443000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                status: TaskStatus::COMPLETED,
                stopped: false,
                hidden: false,
                taskTemplateGroupId: 'kN8-XvqfUMZQX1fIS_xJGg',
            ),
            $model->tasks[1],
        );

        $this->assertEquals(
            new Task(
                id: 'v8vEulUKaqQ80YmZgKBJHQ',
                name: 'Test Task #3',
                completedAt: new \DateTime('2022-03-29T20:31:02.227000+0000'),
                completedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                updatedAt: new \DateTime('2022-03-29T20:31:02.207000+0000'),
                updatedBy: new User(
                    id: 'jYjECYhmNZVxXVLMgDFJ8A',
                    email: 'john.doe@example.com',
                    username: 'John Doe',
                ),
                status: TaskStatus::COMPLETED,
                stopped: false,
                hidden: false,
                taskTemplateGroupId: 'oAgIHCP1ZgyrjOoJ9q1LmA',
            ),
            $model->tasks[2],
        );
    }
}
