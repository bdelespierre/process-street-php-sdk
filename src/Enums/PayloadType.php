<?php

namespace ProcessStreet\Enums;

enum PayloadType: string
{
    case CHECKLIST_CREATED = 'ChecklistCreated';
    case CHECKLIST_COMPLETED = 'ChecklistCompleted';
    case TASK_CHECKED_UNCHECKED = 'TaskCheckedUnchecked';
}
