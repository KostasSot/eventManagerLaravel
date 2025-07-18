<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:draft,published,cancelled',
        ];
    }
}
