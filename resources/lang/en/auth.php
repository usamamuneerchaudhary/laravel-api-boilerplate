<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Authentication Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines are used during authentication for various
	| messages that we need to display to the user. You are free to modify
	| these language lines according to your application's requirements.
	|
	*/

	'failed'   => 'These credentials do not match our records.',
	'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

	'logged_out' => 'User successfully logged out',

	'token' => [
		'expired' => 'Token has been expired',
		'invalid' => 'Token is invalid',
		'missing' => 'Token is missing'
	],
	'email' => [
		'recover' => [
			'error'   => 'We can\'t find a user with that Email address.',
			'success' => 'We have Emailed your password reset link!'
		]
	],

	'password_reset' => [
		'token' => [
			'invalid' => 'This password reset token is invalid.'
		],
		'user'  => [
			'invalid' => "We can't find a user with that Email address."
		]
	]

];
