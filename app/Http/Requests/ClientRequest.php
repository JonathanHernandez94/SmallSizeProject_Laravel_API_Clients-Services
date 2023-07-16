<?php

namespace App\Http\Requests;

class ClientRequest extends BaseFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|string',
            'email'   => 'required|email',
            'phone'   => 'sometimes|regex:/\b[0-9]+\b/|numeric',
            'address' => 'sometimes|string'
        ];
    }

}
