<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 15/11/2017
 * Time: 11:51 CH.
 */
namespace App\Http\Requests\Api\V1;

class KeywordRequest extends Request
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
            'title'          => 'required|max:150',
        ];
    }

    public function messages()
    {
        return ['title.required'         => trans('validation.required'),
            'title.max'                  => trans('validation.max.string'), ];
    }
}
