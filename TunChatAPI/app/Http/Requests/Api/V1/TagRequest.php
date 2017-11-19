<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 18/11/2017
 * Time: 11:44 CH.
 */
namespace App\Http\Requests\Api\V1;

class TagRequest extends Request
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

            'tag'                          => 'required|max:50',

        ];
    }

    public function messages()
    {
        return [
            'tag.required'                           => trans('validation.required'),
            'tag.max'                                => trans('validation.max.string'),

        ];
    }
}
