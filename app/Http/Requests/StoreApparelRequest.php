<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApparelRequest extends FormRequest
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
            'note' => 'required',
            'price' => 'required',
            'color' => 'required',
            'description' => 'nullable',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,jfif,gif,webp|max:2048',
            'purchased_date' => 'nullable',
            'qty' => 'required',
            'type_id' => 'required',
            'style_id' => 'required',
            'brand_id' => 'required',
            'budget_id' => 'nullable',
        ];
    }
}
