<?php

namespace App\Notifications\API\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegisterationEmail extends Notification {
	use Queueable;

	protected $token;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct( $token ) {
		$this->token = $token;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array
	 */
	public function via( $notifiable ) {
		return [ 'mail' ];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail( $notifiable ) {

		$url = config( 'app.url' ) . '/api/v1/user/verify/email' . $this->token;

		return ( new MailMessage )
			->line( 'Account Confirmation Email.' )
			->action( 'Authenticate Email', url( $url ) )
			->line( 'Thank you' );
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param mixed $notifiable
	 *
	 * @return array
	 */
	public function toArray( $notifiable ) {
		return [
			//
		];
	}
}
