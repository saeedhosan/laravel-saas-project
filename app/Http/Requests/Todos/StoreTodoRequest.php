<?php

declare(strict_types=1);

namespace App\Http\Requests\Todos;

use App\Models\Todos;
use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create_todos');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return Todos::$roles;
    }
}
