<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:contacts,email,' . $this->route('contact')?->id],
            'phone' => ['nullable', 'string', 'max:40'],
            'company' => ['nullable', 'string', 'max:150'],
            'status' => ['required', 'in:active,unsubscribed,blacklisted,suppressed'],
            'source' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:2'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
