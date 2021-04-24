<?php


namespace Services\Voluntary\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class VoluntaryRequestRequest extends FormRequest
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
            'resume' => "required|image|max:5000",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadRequest400());
    }
}
