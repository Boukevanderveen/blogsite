<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|max:95',
            'deadline' => 'required',
            'project' => 'required',
            'member' => 'required',
            'status' => 'required',
        ];
    }

        /** 
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            
            'name.required' => 'De naam is verplicht',
            'description.required' => 'De beschrijving is verplicht',
            'description.max' => 'De beschrijving mag niet langer dan 95 letters zijn',
            'deadline.required' => 'De deadline is verplicht',
            'project.required' => 'Het project is verplicht',
            'member.required' => 'De medewerker is verplicht',
            'status.required' => 'De status is verplicht',

        ];
    }
}
