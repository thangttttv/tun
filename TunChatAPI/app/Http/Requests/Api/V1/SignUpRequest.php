<?php
namespace App\Http\Requests\Api\V1;

class SignUpRequest extends Request
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
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'name'          => 'required',
            'client_id'     => 'required',
            'client_secret' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required'                    => trans('validation.required'),
            'email.email'                       => trans('validation.email'),
            'email.unique'                      => trans('validation.unique'),
            'password.required'                 => trans('validation.required'),
            'password_confirmation.required'    => trans('validation.required'),
            'name.required'                     => trans('validation.required'),
            'client_id.required'                => trans('validation.required'),
            'client_secret.required'            => trans('validation.required'),
        ];
    }
}
