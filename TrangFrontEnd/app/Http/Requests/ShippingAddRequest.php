<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddRequest extends FormRequest
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
            'name'=>'required|max:255|min:10',
            'address'=>'required|max:255|min:10',
            'phone'=>'required|max:255|min:10',
            'email'=>'required|max:255|min:10',
            'notes'=>'required|max:255|min:10',
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
            'notes.required' => 'Ghi chú không được phép để trống',
            'notes.unique' => 'Ghi chú không được phép trùng ',
            'notes.max'=>'Ghi chú không được phép quá 255 kí tự',
            'notes.min'=> 'Ghi chú không được phép dưới 10 kí tự',
            'phone.required' => 'SĐT không được phép để trống',
            'phone.unique' => 'SĐT không được phép trùng ',
            'phone.max'=>'SĐT không được phép quá 255 kí tự',
            'phone.min'=> 'SĐT không được phép dưới 10 kí tự',
            'address.required' => 'Địa chỉ không được phép để trống',
            'address.unique' => 'Địa chỉ không được phép trùng ',
            'address.max'=>'Địa chỉ không được phép quá 255 kí tự',
            'address.min'=> 'Địa chỉ không được phép dưới 10 kí tự',
        ];
    }
}
