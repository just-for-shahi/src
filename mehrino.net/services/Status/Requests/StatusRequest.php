<?php


namespace Services\Status\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class StatusRequests extends FormRequest
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
     // TODO ADD NEW RULE
      return [
          'name' => 'required|max:194',
          'phone' => 'required|max:50',
      ];
  }

  protected function failedValidation(Validator $validator)
  {
      throw new HttpResponseException(BadRequest400());
  }
}
