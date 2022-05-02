<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantsPostRequest extends FormRequest
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
            'first_name' => 'required|string|max:50|unique:participants,first_name',
            'date_of_birth' => 'required|date|before:-18 years',
            'frequency_id' => 'required|integer|min:1|exists:frequencies,id',
            'daily_frequency_id' => 'nullable|required_if:frequency_id,1|integer|min:1|exists:daily_frequencies,id'
        ];
    }
}
