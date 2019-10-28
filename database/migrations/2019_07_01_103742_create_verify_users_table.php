<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifyUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'verify_users', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->bigInteger( 'user_id' );
			$table->string( 'email_token' );
			$table->string( 'sms_token' );
			$table->boolean( 'email_token_used' )->default( false );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'verify_users' );
	}
}
