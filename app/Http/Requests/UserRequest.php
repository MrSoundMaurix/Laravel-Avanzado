<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->hasRole("admi");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required_without:idUser|string|min:3|max:50|unique:users',
            'email' => 'required_without:idUser|string|email|min:10|max:50|unique:users',
            'idRol'=>'required|integer|exists:roles,id',

        ];
    }
}
