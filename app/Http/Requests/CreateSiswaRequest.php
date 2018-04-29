<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSiswaRequest extends FormRequest
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
            'nis' => 'required|numeric|digits:10|unique:siswa',
            'nama' => 'required',
            'kelas' => 'required',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages(){
        return [
            'nis.required' => 'NIS harus diisi',
            'nis.numeric' => 'NIS harus angka',
            'nis.digits' => 'NIS harus 10 karakter',
            'nis.unique' => 'NIS sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'kelas.required' => 'Kelas harus diisi',
            'username.required' => 'Username harus diisi',
            'username.max' => 'Username maksimal 20 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password dan Konfirmasi Password tidak cocok',
        ];
    }
}
