<?php
namespace App\Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */

    protected $stopOnFirstFailure = true;

    public function rules(): array
    {
        return [
            'name'               => 'required|max:200',
            'access_level_id'    => 'required|numeric',
            'username'           => ['required', 'regex:/^[a-z0-9]*$/', 'max:100', Rule::unique('users', 'username')->ignore($this->user)->whereNull('deleted_at')],
            'password'           => [$this->isMethod('post') ? 'required' : 'nullable', 'confirmed', 'max:30', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'authenticable_type' => 'nullable|string',
            'authenticable_id'   => 'nullable|integer',
            'email'              => ['required', 'email', 'max:255', Rule::unique('users', 'email') ->ignore($this->user) ->whereNull('deleted_at'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'            => 'O campo Nome é obrigatório.',
            'username.required'        => 'O campo usuário é obrigatório.',
            'username.unique'          => 'Este nome de usuário já está em uso.',
            'username.regex'           => 'O usuário deve conter apenas letras minúsculas e números.',
            'username.max'             => 'O usuário não pode ter mais que 100 caracteres.',
            'password.required'        => 'A senha é obrigatória.',
            'password.confirmed'       => 'As senhas não coincidem.',
            'password.max'             => 'A senha não pode ter mais que 30 caracteres.',
            'password.min'             => 'A senha deve ter no mínimo 8 caracteres.',
            'password.letters'         => 'A senha deve conter letras.',
            'password.mixed'           => 'A senha deve conter letras maiúsculas e minúsculas.',
            'password.numbers'         => 'A senha deve conter números.',
            'password.symbols'         => 'A senha deve conter símbolos.',
            'password.uncompromised'   => 'Esta senha foi encontrada em vazamentos de dados e não é segura.',
            'access_level_id.required' => 'O campo Nível de Acesso é obrigatório.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
