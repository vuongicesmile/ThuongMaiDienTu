<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'name'=>'required|unique:customers|max:255|min:10',
            'email'=>'required|unique:customers|max:255|min:10',
            'password'=>'required|unique:customers|max:255|min:10',
            'phone'=>'required|unique:customers|max:255|min:10',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.unique' => 'Tên không được phép trùng ',
            'name.max'=>'Tên không được phép quá 255 kí tự',
            'name.min'=> 'Tên không được phép dưới 10 kí tự',
            'email.required' => 'Email không được phép để trống',
            'email.unique' => 'Email không được phép trùng ',
            'email.max'=>'Email không được phép quá 255 kí tự',
            'email.min'=> 'Email không được phép dưới 10 kí tự',
            'password.required' => 'Mật khẩu không được phép để trống',
            'password.unique' => 'Mật khẩu không được phép trùng ',
            'password.max'=>'Mật khẩu không được phép quá 255 kí tự',
            'password.min'=> 'Mật khẩu không được phép dưới 10 kí tự',
            'phone.required' => 'SĐT không được phép để trống',
            'phone.unique' => 'SĐT không được phép trùng ',
            'phone.max'=>'SĐT không được phép quá 255 kí tự',
            'phone.min'=> 'SĐT không được phép dưới 10 kí tự',
        ];
    }

}
