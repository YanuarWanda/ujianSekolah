<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGuruRequest extends FormRequest
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
            'nip' => 'required|numeric|digits_between:18,21|unique:guru',
            'nama' => 'required',
            'jenisKelamin' => 'required',
            'bidangKeahlian' => 'required',
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'nip.required' => 'NIP harus diisi',
            'nip.numeric' => 'NIP harus angka',
            'nip.digits_between' => 'Masukkan NIP tanpa spasi',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'username.max' => 'Username maksimal 20 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password dan Konfirmasi Password tidak cocok',
            'bidangKeahlian.required' => 'Bidang Keahlian harus diisi',
            'jenisKelamin.required' => 'Jenis Kelamin harus diisi' 
        ];
    }
}
