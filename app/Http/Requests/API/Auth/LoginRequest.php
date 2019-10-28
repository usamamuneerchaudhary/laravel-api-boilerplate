<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest {
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
			'email'    => 'required|email',
			'password' => 'required'
		];
	}

	public function messages() {
		return [
			'email.required'    => trans( 'validation.login.email.required' ),
			'email.email'       => trans( 'validation.login.email.email' ),
			'password.required' => trans( 'validation.login.password.required' ),
		];
	}
}
