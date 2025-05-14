<?php

namespace App\Http\Requests;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdministrator();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:' . Branch::class],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'manager_id' => ['required', 'string', 'exists:' . User::class . ',id']
        ];
    }
}
