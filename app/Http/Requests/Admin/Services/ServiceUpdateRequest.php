<?php


namespace App\Http\Requests\Admin\Services;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
            'service_name' => 'required|max:255',
            'title' => 'required|max:50',
            'short_description' => 'required',
            'description' => 'required',
            'listing_image' => 'file|mimes:jpg,jpeg,png,bmp',
            'banner_image' => 'file|mimes:jpg,jpeg,png,bmp',
        ];
    }

}
