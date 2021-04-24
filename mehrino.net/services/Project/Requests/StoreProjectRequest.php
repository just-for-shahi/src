<?php


namespace Services\Project\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreProjectRequest extends FormRequest
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
            'institutes' => 'max:194',
            'title' => 'required|min:3|max:194',
            'cover' => 'required|image|max:5000',
            'content' => 'nullable|max:10000',
            'latitude' => 'nullable|numeric|max:100',
            'longitude' => 'nullable|numeric|max:100',
            'target' => 'required|numeric',
            'current_balance' => 'nullable|numeric',
            'collaborators' => 'nullable|numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadRequest400($validator->getMessageBag()));
    }
}
