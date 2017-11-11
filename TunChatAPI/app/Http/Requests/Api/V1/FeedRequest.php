<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 09/11/2017
 * Time: 10:44 SA.
 */
namespace App\Http\Requests\Api\V1;

class FeedRequest extends Request
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
            'page_id'                   => 'required|numeric',
            'feed_facebook_id'          => 'required|max:50',
            'message'                   => 'required|max:500',
            'description'               => 'max:500',
            'picture'                   => 'url|max:500',
            'full_picture'              => 'url|max:500',
            'caption'                   => 'max:150',
            'link'                      => 'url|max:500',
            'published'                 => 'required|numeric|in:1,0',
        ];
    }

    public function messages()
    {
        return [
            'page_id.required'                    => trans('validation.required'),
            'page_id.numeric'                     => trans('validation.numeric'),
            'feed_facebook_id.required'           => trans('validation.required'),
            'feed_facebook_id.max'                => trans('validation.max.string'),
            'message.required'                    => trans('validation.required'),
            'message.max'                         => trans('validation.max.string'),
            'description.max'                     => trans('validation.max.string'),
            'picture.url'                         => trans('validation.url'),
            'picture.max'                         => trans('validation.max.string'),
            'full_picture.url'                    => trans('validation.url'),
            'full_picture.max'                    => trans('validation.max.string'),
            'link.url'                            => trans('validation.url'),
            'link.max'                            => trans('validation.max.string'),
            'caption.max'                         => trans('validation.max.string'),
            'published.numeric'                   => trans('validation.numeric'),
            'published.in'                        => trans('validation.in'),

        ];
    }
}
