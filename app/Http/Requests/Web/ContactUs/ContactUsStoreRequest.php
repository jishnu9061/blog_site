<?php


namespace App\Http\Requests\Web\ContactUs;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsStoreRequest extends FormRequest
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
            'customer_name' => 'required|max:255',
            'email' => 'required|string|email',
            'subject' => 'required|string',
            'messages' => 'required|string',
        ];
    }

}
