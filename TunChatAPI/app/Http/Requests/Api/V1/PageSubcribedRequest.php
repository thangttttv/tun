<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 06/11/2017
 * Time: 11:31 CH.
 */
namespace App\Http\Requests\Api\V1;

class PageSubcribedRequest extends Request
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
            'page_id'                  => 'required',
            'access_token'             => 'required',
        ];
    }

    public function messages()
    {
        return [
            'page_id.required'                  => trans('validation.required'),
            'access_token.required'             => trans('validation.required'),

        ];
    }
}
