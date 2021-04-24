<?php


namespace Services\Chat\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Validation\Rule;
use Services\Ticket\Enum\AttachmentType;


class ChatRequest extends FormRequest
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
      ];
  }

  protected function failedValidation(Validator $validator)
  {
      throw new HttpResponseException(BadRequest400());
  }
}