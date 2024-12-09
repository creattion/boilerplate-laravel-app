<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserInviteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'email' => ['required', 'email', 'max:200'],
        ];
    }

    public function messages(): array
    {
        return [
            'company_id' => [
                'required' => 'Selecione uma empresa',
                'exists' => 'Selecione uma empresa',
            ],
            'email' => [
                'required' => 'Digite o email',
                'max' => 'Digite no máximo :max caracteres',
                'email' => 'Email inválido',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
