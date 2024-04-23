<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdPackageStoreRequest extends FormRequest
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'count' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'يجب ان تكون صورة',
        ];
    }
}
