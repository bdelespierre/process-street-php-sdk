<?php

namespace ProcessStreet\Models\FormFields;

use ProcessStreet\Models\File;
use ProcessStreet\Models\FormField;

class FileFormField extends FormField
{
    public function getValue(): ?File
    {
        if (is_null($this->rawValue)) {
            return null;
        }

        return new File($this->rawValue);
    }
}
