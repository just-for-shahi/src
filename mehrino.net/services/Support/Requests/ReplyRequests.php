<?php


namespace Services\Support\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Factory as ValidationFactory;
use Services\Attachment\Enum\AttachmentType;


class ReplyRequests extends FormRequest
{

    public function __construct(ValidationFactory $validationFactory)
    {
//        try {
//            $validationFactory->extend(
//                'attachment',
//                function ($attribute, $value, $parameters) {
//                   $c= collect($value);
//                    if(!$c->has('value') || !$c->has('type')){
//                        return false;
//                    }
//                    if ($value['type'] === AttachmentType::$IMAGE) {
//                        if (in_array($value['value']->getMimeType(), getMimeTypeImage()) and $value['value']->getSize() < 50001) {
//                            return true;
//                        }
//                    }
//                    if ($value['type'] === AttachmentType::$FILE) {
//                        if (in_array($value['value']->getMimeType(), getMimeTypeFile()) and $value['value']->getSize() < 50001) {
//                            return true;
//                        }
//                    }
//                    return false;
//                },
//                'Sorry,The selected :attribute is invalid.'
//            );
//        } catch (\Exception $e) {
//            throw new HttpResponseException(BadRequest400());
//        }

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
            'message' => 'required|max:5000',
            "attachment" => "image|max:5000",
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(BadRequest400());
    }
}
