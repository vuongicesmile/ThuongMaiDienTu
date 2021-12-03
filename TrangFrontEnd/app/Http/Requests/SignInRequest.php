<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
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
            'email'=>'required|max:255|min:10',
            'password'=>'required|max:255|min:10',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email không được phép để trống',
            'email.unique' => 'Email không được phép trùng ',
            'email.max'=>'Email không được phép quá 255 kí tự',
            'email.min'=> 'Email không được phép dưới 10 kí tự',
            'password.required' => 'Mật khẩu không được phép để trống',
            'password.unique' => 'Mật khẩu không được phép trùng ',
            'password.max'=>'Mật khẩu không được phép quá 255 kí tự',
            'password.min'=> 'Mật khẩu không được phép dưới 10 kí tự',
        ];
    }
}
