<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }

    //バリデーション失敗時にjsonでレスポンスを返す
    protected function failedValidation(Validator $validator)
    {
        $res = response() -> json([
            'error' => 'Bud Request', 400
        ]);
        throw new HttpResponseException($res);
    }
}
