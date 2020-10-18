<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OnlyRustaveli implements Rule {

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        if (strpos($value, '@rustaveli.org.ge') !== false) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'Only @rustaveli.org.ge E-mail is allowed.';
    }
}
