<?php

namespace App\Http\Requests;

use App\Models\Branch;
use App\Models\Site;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiteRequest extends FormRequest
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
            'terminal_id' => ['required', 'string', 'unique:' . Site::class],
            'name' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'latitude' => ['nullable'],
            'longitude' => ['nullable'],
            'contract_document' => 'required|mimes:pdf|max:500|min:100',
            'branch_id' => ['required', 'exists:' . Branch::class . ',id'],
        ];
    }
}
