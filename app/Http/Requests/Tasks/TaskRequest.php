<?php

namespace App\Http\Requests\Tasks;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:' . Carbon::now()->toDateString(),
            'end_date' => 'required|date|after_or_equal:' . Carbon::now()->toDateString(),
            'completed' => 'nullable|boolean|in:0,1',
        ];
    }
}
