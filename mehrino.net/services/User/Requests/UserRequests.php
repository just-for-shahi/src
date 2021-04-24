<?php


namespace Services\User\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequests extends FormRequest
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
            'name' => 'required|max:194',
            'file' => 'nullable|image|max:5000',
            'mobile' => array('nullable', 'regex:/^[0-9]{1,4}[0-9]{10}$/u'),
            'email' => array('nullable', 'regex:/(^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$)/u')
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(BadRequest400());
    // }
}
