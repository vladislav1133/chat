<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;

class FirstMessageRule implements Rule
{

    protected $length;
    /**
     * Create a new rule instance
     *
     * FirstMessageRule constructor.
     * @param $length
     */
    public function __construct($length)
    {
        $this->length = $length;
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
        $user = Auth::user();

        if (strlen($value) > 200 && !$user->messages()->count()) return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The first :attribute may not be greater than $this->length characters.";
    }
}
