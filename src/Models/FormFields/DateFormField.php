<?php

namespace ProcessStreet\Models\FormFields;

use DateTime;
use DateTimeInterface;
use ProcessStreet\Models\FormField;

class DateFormField extends FormField
{
    public function getValue(): ?DateTimeInterface
    {
        if (is_null($this->rawValue)) {
            return null;
        }

        return new DateTime($this->rawValue);
    }
}
