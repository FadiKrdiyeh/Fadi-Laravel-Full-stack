<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StyleRequest extends FormRequest
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
            'title' => 'max:30|required',
            'description' => 'max:1000|required',
            'image' => 'mimes:png,jpg,jpeg,gif|required',
            'html_code' => 'required',
            'css_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => __('messages.Title May Be Less Than 30 Characters!!'),
            'title.required' => __('messages.Title is required!!'),
            'description.required' => __('messages.Description is required!!'),
            'description.max' => __('messages.Description May Be Less Than 1000 Characters!!'),
            'image.mimes' =>  __('messages.Invalid Image!!'),
            'image.required' =>  __('messages.Image is required!!'),
            'html_code.required' =>  __('messages.HTML code is required!!'),
            'css_code.required' =>  __('messages.CSS code is required!!'),
        ];
    }
}
