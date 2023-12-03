<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePaintingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == 'pelukis' && Carbon::now() < auth()->user()->subscription->expired_date;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:32|unique:paintings',
            'year' => 'required|date_format:Y',
            'description' => 'required|string',
            'material' => 'required|string',
            'category' => 'required|string',
            'height' => 'required|integer|between:0,1000',
            'width' => 'required|integer|between:0,1000',
            'images' => 'required|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
