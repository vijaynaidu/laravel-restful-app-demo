<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSubscriptionEmailLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('subscription_email_logs', function(Blueprint $table)
		{
			$table->foreign('subscription_id', 'subscription_email_logs_ibfk_1')->references('id')->on('subscriptions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('post_id', 'subscription_email_logs_ibfk_2')->references('id')->on('posts')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('subscription_email_logs', function(Blueprint $table)
		{
			$table->dropForeign('subscription_email_logs_ibfk_1');
			$table->dropForeign('subscription_email_logs_ibfk_2');
		});
	}

}
