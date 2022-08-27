<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class LookupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'numbers' => [
                'required',
                'string',
            ],
        ];
    }

    public function numbers(): array
    {
        $numbers = array_map(function (string $number) {
            return preg_replace('/[^0-9]/', '', $number);
        }, explode(PHP_EOL, $this->input('numbers')));

        if (count($numbers) > 150) {
            throw ValidationException::withMessages([
                'numbers' => 'Maximum amount of numbers exceeded. 150 numbers is the limit.',
            ]);
        }

        return $numbers;
    }
}
