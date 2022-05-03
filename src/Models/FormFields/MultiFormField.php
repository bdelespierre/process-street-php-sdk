<?php

namespace ProcessStreet\Models\FormFields;

use ProcessStreet\Models\FormField;

class MultiFormField extends FormField
{
    /**
     * @return array<string>|null
     */
    public function getValue(): ?array
    {
        if (is_null($this->rawValue)) {
            return null;
        }

        return explode(', ', $this->rawValue);
    }
}
