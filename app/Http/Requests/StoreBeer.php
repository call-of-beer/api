<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeer extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'alcohol_volume' => ['required', 'string', 'max:5'],
            'country' => ['required', 'string', 'max:25'],
            'type_id' => ['integer'],
            'description' => ['string', 'max:200']
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'alcohol_volume.required' => 'Alcohol by volume is required!',
            'country.required' => 'Country is required!'
        ];
    }
}
