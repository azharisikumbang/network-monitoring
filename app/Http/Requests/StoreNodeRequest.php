<?php

namespace App\Http\Requests;

use App\Models\Node;
use App\Models\Site;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNodeRequest extends FormRequest
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
            'name' => ['nullable', 'present', 'string', 'unique:' . Node::class],
            'ip_address' => ['required', 'ipv4'],
            'network_address' => ['required'],
            'type' => [
                'required',
                Rule::in([
                    'MODEM',
                    'ROUTER',
                    'ACCESS_POINT',
                    'OLT',
                    'ONT',
                    'SERVER'
                ])
            ],
            'description' => ['nullable'],
            'config_snmp_port' => ['sometimes', 'nullable'],
            'config_snmp_key' => ['sometimes', 'nullable', 'string'],
            'config_ssh_port' => ['sometimes', 'nullable'],
            'config_ssh_public_key' => ['sometimes', 'nullable', 'string'],
            'site_id' => ['required', 'exists:' . Site::class . ',id'],
        ];
    }
}
