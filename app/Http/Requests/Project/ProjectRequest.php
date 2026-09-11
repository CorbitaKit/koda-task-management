<?php

namespace App\Http\Requests\Project;

use App\Enums\Project\ProjectPriority;
use App\Enums\Project\ProjectStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProjectRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'client_name' => [
                'required',
                'string',
            ],

            'project_name' => [
                'required',
                'string',
            ],

            'status' => [
                'required',
                Rule::enum(ProjectStatus::class),
            ],

            'priority' => [
                'required',
                Rule::enum(ProjectPriority::class),
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'due_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
        ];
    }
}
