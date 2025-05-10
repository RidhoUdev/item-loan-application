<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($userId)],
            'role' => ['required', 'string', Rule::in(['operator', 'user'])],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan oleh user lain.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah digunakan oleh user lain.',
            'email.max' => 'Alamat email tidak boleh lebih dari 255 karakter.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
            'phone.unique' => 'Nomor telepon ini sudah digunakan oleh user lain.',
            'role.required' => 'Peran (role) wajib dipilih.',
            'role.in' => 'Peran (role) yang dipilih tidak valid.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru minimal harus 8 karakter.',
        ];
    }
}
