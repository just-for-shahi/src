<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEpisodeRequest extends FormRequest
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
            'podcast' => 'required|numeric|exists:podcasts,id',
            'title' => 'required|string',
            'description' => 'required',
            'file' => 'required|file',
            'plus' => 'required|numeric|between:0,1'
        ];
    }

    /**
     * @return array
     */
    public function messages(){
        return [
            'podcast.required' => 'لطفا پادکست مربوطه را انتخاب کنید',
            'podcast.numeric' => 'لطفا پادکسن مربوطه را انتخاب کنید',
            'podcast.exists' => 'لطفا پادکست مروبطه را انتخاب کنید',
            'title.required' => 'لطفا عنوان اپیزود را وارد کنید',
            'title.string' => 'لطفا برای عنوان از کاراکترهای مجاز استفاده کنید',
            'description.required' => 'لطفا توضیحات اپیزود را وارد کنید',
            'file.required' => 'لطفا فایل اپیزود را انتخاب کنید',
            'file.file' => 'لطفا فایل استاندارد برای اپیزود انتخاب کنید',
            'plus.required' => 'لطفا هیربد پلاس را انتخاب کنید',
            'plus.numeric' => 'لطفا هیربد پلاس را انتخاب کنید',
            'plus.between' => 'لطفا هیربد پلاس را اتتخاب کنید'
        ];
    }
}
