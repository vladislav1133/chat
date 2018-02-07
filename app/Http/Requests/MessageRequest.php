<?php

namespace App\Http\Requests;

use App\Rules\FirstMessageRule;
use App\Rules\SpamMessageRule;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => [
                'required',
                'min:1',
                new FirstMessageRule(200),
                new SpamMessageRule()
        ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'title.required' => 'A title is required',
          //  'body.required'  => 'A message is required',
        ];
    }
}
