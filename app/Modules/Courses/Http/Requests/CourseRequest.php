<?php
namespace App\Modules\Courses\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'course_id'  => 'required|integer|exists:courses,id',
            'user_id'    => 'required|integer|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'turma.required'      => 'O campo Nome da Turma é obrigatório.',
            'turma.string'        => 'O campo Nome da Turma deve ser um texto.',
            'turma.max'           => 'O campo Nome da Turma deve ter no máximo 255 caracteres.',

            'course_id.required'  => 'O campo Curso é obrigatório.',
            'course_id.integer'   => 'O Curso selecionado é inválido.',
            'course_id.exists'    => 'O Curso selecionado não existe.',

            'disciplina.required' => 'O campo Disciplina é obrigatório.',
            'disciplina.string'   => 'O campo Disciplina deve ser um texto.',
            'disciplina.max'      => 'O campo Disciplina deve ter no máximo 255 caracteres.',

            'user_id.required'    => 'O campo Professor Responsável é obrigatório.',
            'user_id.integer'     => 'O Professor selecionado é inválido.',
            'user_id.exists'      => 'O Professor selecionado não existe.',
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
