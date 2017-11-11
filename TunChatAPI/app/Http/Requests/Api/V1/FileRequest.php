<?php
namespace App\Http\Requests\Api\V1;

class FileRequest extends Request
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
            'file' => 'required|mimes:jpg,jpeg,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => trans('validation.required'),
            'file.mimes'    => trans('validation.mimes'),
        ];
    }
}
