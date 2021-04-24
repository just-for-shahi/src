<?php


namespace Services\Institute\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Validation\Rule;


class InstituteRequest extends FormRequest
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
          'title' => 'required|max:194',
          'registered_no' => 'required|max:194',
          'license_no' => 'required|max:194',
          'ceo' => 'required|max:194',
          'branch.*.title' => 'min:1|max:194',
          'board_member.*.name' => 'min:1|max:194',
      ];
  }

  protected function failedValidation(Validator $validator)
  {
      throw new HttpResponseException(BadRequest400($validator->getMessageBag()));
  }
}
