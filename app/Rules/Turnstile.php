<?php

namespace App\Rules;

use App\Helpers\TurnstileHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Turnstile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!TurnstileHelper::verify($value)) {
            $fail(config('turnstile.error_messages.turnstile_check_message'));
        }
    }
}
