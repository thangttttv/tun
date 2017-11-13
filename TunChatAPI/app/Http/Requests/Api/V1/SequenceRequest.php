<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 12/11/2017
 * Time: 2:14 SA.
 */
namespace App\Http\Requests\Api\V1;

class SequenceRequest extends Request
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
            'page_id'       => 'required|numeric',
            'title'         => 'required|max:150',
            'sent_date'     => 'in:All,monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'sent_time_from'=> 'max:5',
            'sent_time_to'  => 'max:5',

        ];
    }

    public function messages()
    {
        return [
            'page_id.required'       => trans('validation.required'),
            'page_id.numeric'        => trans('validation.numeric'),
            'title.required'         => trans('validation.required'),
            'title.max'              => trans('validation.max.string'),
            'sent_date.required'     => trans('validation.required'),
            'sent_date.in'           => trans('validation.in'),
            'sent_time_from.required'=> trans('validation.required'),
            'sent_time_from.max'     => trans('validation.max.string'),
            'sent_time_to.required'  => trans('validation.required'),
            'sent_time_to.max'       => trans('validation.max.string'),

        ];
    }
}
