<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 18/11/2017
 * Time: 11:23 CH.
 */
namespace App\Http\Requests\Api\V1;

class FieldRequest extends Request
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
            'field'                         => 'required|max:25',
            'type'                          => 'required|in:Text,Number,Date,Date&Time,Boolean',
            'status'                        => 'required|numeric|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'field.required'                                 => trans('validation.required'),
            'type.required'                                  => trans('validation.required'),
            'status.required'                                => trans('validation.required'),
            'field.max'                                      => trans('validation.max.string'),
            'status.numeric'                                 => trans('validation.numeric'),
            'status.in'                                      => trans('validation.in'),

        ];
    }
}
