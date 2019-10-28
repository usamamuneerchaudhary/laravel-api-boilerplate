<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRecoverRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'email' => 'required|max:255|email',
		];
	}

	public function messages() {
		return [
			'email.required' => trans( 'validation.register.email.required' ),
			'email.email'    => trans( 'validation.register.email.email' )
		];
	}
}
