<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|alpha|min:2',
            'last_name' => 'required|alpha|min:2',
            'email' => "required|email|unique:users,email,{$this->get('id')}",
            'title_id' => 'numeric',
        ];

        return $rules;
    }
}
