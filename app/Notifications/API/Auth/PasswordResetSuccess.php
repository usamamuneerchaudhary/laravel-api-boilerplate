<?php

namespace App\Notifications\API\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetSuccess extends Notification {
	use Queueable;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct( $notifiable ) {
		//
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
		return ( new MailMessage )
			->line( 'You have changed your password successfully.' )
			->line( 'If you did change password, no further action is required.' )
			->line( 'If you did not change password, contact your system administrator immediately to protect your account.' );
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
