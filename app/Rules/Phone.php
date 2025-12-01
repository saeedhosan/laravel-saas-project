<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{
    protected $value;

    /**
     * Create a new rule instance.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {

        return preg_match('%^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-. \\\/]?)?((?:\(?\d+\)?[\-. \\\/]?)*)(?:[\-. \\\/]?(?:#|ext\.?|extension|x)[\-. \\\/]?(\d+))?$%i', $value) && mb_strlen($value) >= 7 && mb_strlen($value) <= 17;
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return __('locale.customer.invalid_phone_number', ['phone' => $this->value]);
    }
}
