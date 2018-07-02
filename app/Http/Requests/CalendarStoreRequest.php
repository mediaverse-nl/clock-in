<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarStoreRequest extends FormRequest
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
            'title' => 'required|max:100',
            'description' => 'nullable|max:200',
            'user' => 'required_if:title,==,werk,==,vrij',
            'full_day' => 'required_if:title,==,feestdag',
            'private' => 'required_if:title,==,werk|required_with:user',
            'start' => 'required|date',
            'stop' => 'nullable|required_if:title,==,werk,==,afspraak|date|after_or_equal:start',
        ];
    }
}
