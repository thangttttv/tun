<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 08/11/2017
 * Time: 11:00 CH.
 */
namespace App\Http\Requests\Api\V1;

class CustomerRequest extends Request
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
            'page_id'              => 'required|numeric',
            'facebook_id'          => 'required|max:50',
            'name'                 => 'required|max:250',
            'email'                => 'email',
            'gender'               => 'in:male,female',
            'avatar_url'           => 'url',
            'subscribed'           => 'numeric',
            'can_reply'            => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'page_id.required'               => trans('validation.required'),
            'page_id.numeric'                => trans('validation.numeric'),
            'facebook_id.required'           => trans('validation.required'),
            'facebook_id.max'                => trans('validation.max.string'),
            'name.required'                  => trans('validation.required'),
            'name.max'                       => trans('validation.max.string'),
            'email.email'                    => trans('validation.email'),
            'gender.in'                      => trans('validation.in'),
            'avatar_url.url'                 => trans('validation.url'),
            'subscribed.numeric'             => trans('validation.numeric'),
            'can_reply.numeric'              => trans('validation.numeric'),

        ];
    }
}
