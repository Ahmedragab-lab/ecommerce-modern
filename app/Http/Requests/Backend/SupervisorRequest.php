<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SupervisorRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'firstname'     => 'required',
                    'lastname'      => 'required',
                    'email'         => 'required|email|max:255|unique:users',
                    'phone'         => 'required|numeric|unique:users',
                    'status'        => 'required',
                    'password'      => 'required|min:6',
                    'image'         => 'nullable|mimes:jpg,jpeg,png,svg|max:20000'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'firstname'     => 'required',
                    'lastname'      => 'required',
                    'email'         => 'required|email|max:255|unique:users,email,'.$this->route()->admin->id,
                    'phone'         => 'required|numeric|unique:users,phone,'.$this->route()->admin->id,
                    'status'        => 'required',
                    'password'      => 'nullable|min:6',
                    'image'         => 'nullable|mimes:jpg,jpeg,png,svg|max:20000'
                ];
            }
            default: break;
        }
    }
}
