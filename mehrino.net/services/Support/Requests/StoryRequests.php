<?php


namespace Services\Support\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Validation\Rule;
use Services\Support\Enum\AttachmentType;


class StoryRequests extends FormRequest
{

    public function __construct(ValidationFactory $validationFactory)
    {

        $validationFactory->extend(
            'attachment',
            function ($attribute, $value, $parameters) {
                if ($value['type'] === AttachmentType::$IMAGE) {
                    if (in_array($value['value']->getMimeType(), getMimeTypeImage()) and $value['value']->getSize()<50001) {
                        return true;
                    }
                }
                if ($value['type'] === AttachmentType::$FILE) {
                    if (in_array($value['value']->getMimeType(), getMimeTypeFile()) and $value['value']->getSize()<50001) {
                        return true;
                    }
                }
                return false;
            },
            'Sorry,The selected :attribute is invalid.'
        );
    }


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
            'priority' => [
                'required',
                Rule::in(priorities()),
            ],
            'message' => 'required|max:5000',
            'department' => Rule::in(departments()),
            "attachment" => "attachment",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadRequest400());
    }
}
