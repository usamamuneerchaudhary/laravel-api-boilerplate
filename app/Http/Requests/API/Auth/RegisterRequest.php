<?php

namespace App\Http\Requests\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {
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
			'first_name'            => 'required|regex:/^[a-zA-Z]+$/u|max:255',
			'last_name'             => 'required|regex:/^[a-zA-Z]+$/u|max:255',
			'email'                 => 'required|email|max:255|unique:users',
			'phone_number'          => 'required|pakistan_phone_number|max:255|min:10|unique:users',
			'password'              => 'required|min:8|confirmed|strong_password',
			'password_confirmation' => 'required|min:8'
		];
	}

	public function messages() {
		return [
			'first_name.required' => trans( 'validation.register.first_name.required' ),
			'first_name.regex'    => trans( 'validation.register.first_name.regex' ),
			'last_name.required'  => trans( 'validation.register.last_name.required' ),
			'last_name.regex'     => trans( 'validation.register.last_name.regex' ),
			'email.required'      => trans( 'validation.register.email.required' )

		];
	}
}
