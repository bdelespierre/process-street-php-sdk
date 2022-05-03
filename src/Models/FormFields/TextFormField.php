<?php

namespace ProcessStreet\Models\FormFields;

use ProcessStreet\Models\FormField;

class TextFormField extends FormField
{
    public function getValue(): ?string
    {
        if (is_null($this->rawValue)) {
            return null;
        }

        return $this->rawValue;
    }
}
