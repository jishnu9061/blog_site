<?php

namespace App\Http\Requests\Admin\PageManagement;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialsRequest extends FormRequest
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
            'posted_by' => 'required|string|max:255',
            'message' => 'required|string|max:250',
            'profile_image' => 'required|image',

//            'video' => 'required|file|mimes:mp4,avi,3gp,wmv',
//            'section_1_video' => 'required',
        ];
    }
}
