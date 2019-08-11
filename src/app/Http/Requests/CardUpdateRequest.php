<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardUpdateRequest extends FormRequest
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
//        TODO CHECK IF NEW CARD CAN STILL BE ADDED BY CLOCKING IN
        return [
            'value'  => 'required',
            'user_id'  => 'numeric|nullable',
        ];
    }
}
