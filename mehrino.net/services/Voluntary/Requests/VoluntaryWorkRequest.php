<?php


namespace Services\Voluntary\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class VoluntaryWorkRequest extends FormRequest
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
            'institutes' => "nullable|string",
            'title' => "required|string|min:3",
            'audience' => "required|string",
            'period' => "nullable|numeric",
            'language' => "nullable|string",
            'location' => "nullable|string",
            'latitude' => "required|numeric",
            'longitude' => "required|numeric",
            'address' => "nullable|string",
            'capacity' => "nullable|numeric",
            'description' => "nullable|string",
            'date' => "required|date",
            'cover' => 'nullable|image|max:5000',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadRequest400());
    }
}
