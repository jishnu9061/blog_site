<?php

namespace App\Http\Requests\User;

use App\Http\Constants\AuthConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'max:50',
            'email' => 'required|email|unique:admins,email,'.Auth::guard('user')->id(),
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,mobile,'.Auth::guard('user')->id(),
            'profile_image' => 'file|mimes:jpg,jpeg,png',
        ];
    }
}
