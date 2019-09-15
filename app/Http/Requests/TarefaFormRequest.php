<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefaFormRequest extends FormRequest
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
            'nome_tarefa' => 'required|max:255',
            'custo' => 'required|numeric|between:0,9999999.99',
            'data_limite' => 'nullable|date',
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
            'nome_tarefa.required' => 'Precisamos do nome da tarefa!',
			'nome_tarefa.max' => 'Número de caracteres ultrapassa o limite (:max)',
            'custo.required' => 'Precisamos do custo da tarefa!',
			'custo.numeric' => 'Custo deve ser um número!',
			'custo.between' => 'Custo deve estar no intervalo :min - :max!',
			'data_limite.date' => 'Formato de data invalido!',
        ];
    }
}
