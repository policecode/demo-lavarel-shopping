<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PaymentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => ['required', 'min:4', 'max:255'],
            'phone' => ['required', 'regex:/(0)[0-9]/', 'not_regex:/[a-z]/', 'min:9', 'max:11'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'max:255'],
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'email' => ':attribute không đúng định dạng',
            'min' => ':attribute không được ít hơn :min ký tự',
            'max' => ':attribute không được nhiều hơn :max ký tự',
            'regex' => ':attribute không đúng định dạng',
            'not_regex' => ':attribute không tồn tại chữ cái'
        ];
    }
    public function attributes()
    {
        return [
            'phone' => 'Số điện thoại',
            'email' => 'Địa chỉ email',
            'fullname' => 'Họ và tên',
            'address' => 'Địa chỉ nhận hàng'
        ];
    }

}
