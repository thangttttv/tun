<?php
/**
 * Created by PhpStorm.
 * User: ThangTT
 * Date: 08/11/2017
 * Time: 5:48 CH
 */

namespace App\Http\Requests\Api\V1;


class PaginationCustomerRequest extends PaginationRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'page_id' => 'required',
		];
	}

	public function messages()
	{
		return [
			'page_id.required' => trans('validation.required'),

		];
	}
}