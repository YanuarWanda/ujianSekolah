<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSiswaRequest extends FormRequest
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
            'nis' => 'required|numeric|digits:10|unique:siswa,nis',
            'nama' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|max:20|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'jenisKelamin' => 'required',    
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nis.required' => 'NIS wajib diisi',
            'nis.numeric' => 'NIS harus angka',
            'nis.digits' => 'NIS harus 10 digit',
            'nis.unique' => 'NIS sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.max' => 'Username maksimal 20 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password dan konfirmasi tidak sama',
            'jenisKelamin.required' => 'Jenis Kelamin wajib diisi',
        ];
    }

    // public function response (array $errors){
    //     return new JsonResponse($errors, 422);
    // }
}
