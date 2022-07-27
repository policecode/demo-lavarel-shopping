<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StringAdmin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        // Trả về false là hiện lỗi của rule
        if (mb_strtolower($value, 'UTF-8') == 'admin@gmail.com') {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute không hợp lệ';
    }
}
