<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:160'],
            'subject' => ['required', 'string', 'max:190'],
            'sender_name' => ['required', 'string', 'max:140'],
            'sender_email' => ['required', 'email'],
            'reply_to_email' => ['nullable', 'email'],
            'type' => ['required', 'in:regular,scheduled,draft,recurring,ab_test'],
            'status' => ['required', 'in:draft,scheduled,processing,sent,paused,failed'],
            'scheduled_at' => ['nullable', 'date'],
            'email_template_id' => ['nullable', 'exists:email_templates,id'],
        ];
    }
}
