<?php
namespace App\Http\Requests\Api\V1;

class UserDeviceRequest extends Request
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
            'token'           => 'required',
            'type'            => 'required|in:ios,android,web',
        ];
    }

    public function messages()
    {
        return [
            'token.required'           => config('api.validateErrors.required'),
            'type.required'            => config('api.validateErrors.required'),
            'type.in'                  => config('api.validateErrors.in'),
        ];
    }
}
