<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'firstname'=>'string|required',
            'surname'=>'string|required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'role'=> 'required|string'
        ];
    }
}
