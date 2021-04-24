<?php


namespace Services\Project\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;



class UpdateProjectRequest extends FormRequest
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
          'title' => 'required|min:3|max:194',
          'content' => 'max:10000',
          'latitude' => 'required|max:100',
          'longitude' => 'required|max:100',
          'target' => 'required|numeric',
          'current_balance' => 'required|numeric',
          'collaborators' => 'required|numeric',
      ];
  }

  protected function failedValidation(Validator $validator)
  {
      throw new HttpResponseException(BadRequest400());
  }
}
