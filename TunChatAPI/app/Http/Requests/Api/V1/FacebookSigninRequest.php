<?php
namespace App\Http\Requests\Api\V1;

class FacebookSigninRequest extends Request
{
    public function rules()
    {
        return [
            'facebook_token' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'facebook_token.required' => trans('validation.required'),
        ];
    }
}
