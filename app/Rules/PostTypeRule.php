<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PostTypeRule implements Rule, DataAwareRule
{
    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->data['type'] === "text" && Validator::make(['content' => $this->data['content']], ['content' => 'string'])->passes()) {
            return true;
        } else if ($this->data['type'] === "link" && Validator::make(['content' => $this->data['content']], ['content' => 'url'])->passes()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid content for type.';
    }
}
