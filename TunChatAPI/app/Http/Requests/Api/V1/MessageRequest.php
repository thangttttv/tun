<?php
namespace App\Http\Requests\Api\V1;

class MessageRequest extends Request
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
            'content'          => 'required',
        ];
    }

    public function messages()
    {
        return ['content.required'         => trans('validation.required')];
    }
}
