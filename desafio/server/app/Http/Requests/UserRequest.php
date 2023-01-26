<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!$this->header('X-API-Signature')) {
            return false;
        }

        return sodium_crypto_sign_verify_detached(
            base64_decode($this->header('X-API-Signature')),
            $this->getMethod() . ';/' . $this->path() . ';' . $this->getContent(),
            hex2bin(config('app.client_public_key'))
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
