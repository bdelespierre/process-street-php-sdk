<?php

namespace ProcessStreet\Enums;

enum FormFieldType: string
{
    case MULTISELECT = 'MultiSelect';
    case TEXT = 'Text';
    case TEXTAREA = 'Textarea';
    case EMAIL = 'Email';
    case URL = 'Url';
    case FILE = 'File';
    case DATE = 'Date';
    case NUMBER = 'Number';
    case SELECT = 'Select';
    case MULTICHOICE = 'MultiChoice';
    case MEMBERS = 'Members';
}
