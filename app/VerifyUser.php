<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model {
	const EXPIRATION_TIME = 15; // minutes
    protected $table = 'verify_users';

	protected $guarded = [];

	public function user() {
		return $this->belongsTo( User::class, 'user_id' );
	}

//	public function __construct( array $attributes = [] ) {
//		if ( ! isset( $attributes['code'] ) ) {
//			$attributes['code'] = $this->generateCode();
//		}
//
//		parent::__construct( $attributes );
//	}

	/**
	 * @param int $codeLength
	 *
	 * @return int
	 * @throws \Exception
	 */
	public function generateCode( $codeLength = 4 ) {
		$min = 10 ** $codeLength;
		$max = $min * 10 - 1;

		return random_int( $min, $max );

	}


	/**
	 * True if the token is not used nor expired
	 *
	 * @return bool
	 */
	public function isValid() {
		return ! $this->isUsed() && ! $this->isExpired();
	}

	/**
	 * Is the current token used
	 *
	 * @return bool
	 */
	public function isUsed() {
		return $this->used;
	}

	/**
	 * Is the current token expired
	 *
	 * @return bool
	 */
	public function isExpired() {
		return $this->created_at->diffInMinutes( Carbon::now() ) > static::EXPIRATION_TIME;
	}

}
