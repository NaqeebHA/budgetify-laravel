<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBudgetRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'in_out' => 'required',
            'amount' => 'required',
            'note' => 'nullable',
            'description' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,jfif,gif|max:2048',
            'txn_datetime' => 'required',
            'category_id' => 'required',
            'account_id' => 'required',
        ];
    }
}
