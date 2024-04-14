<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name'              => 'nullable',
            'email'             => 'nullable|email',
            'phone'             => 'nullable',
            'password'          => 'nullable',
            'id_number'         => 'nullable|integer',
            'licence_status'    => 'nullable',
            'birthday'          => 'nullable',
            'licence_file'      => 'nullable|file:png,jpg,jpeg,svg,webp,pdf',
            'id_number_file'    => 'nullable|file:png,jpg,jpeg,svg,webp,pdf',
            'photo'    => 'nullable|file:png,jpg,jpeg,svg,webp,pdf',
        ];
    }
}
