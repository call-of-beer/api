<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRating extends FormRequest
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
            'aroma' => ['integer'],
            'color' => ['integer'],
            'taste' => ['integer'],
            'bitterness' => ['integer'],
            'texture' => ['integer'],
            'overall' => ['integer'],
            'comment' => ['string']
        ];
    }
}
