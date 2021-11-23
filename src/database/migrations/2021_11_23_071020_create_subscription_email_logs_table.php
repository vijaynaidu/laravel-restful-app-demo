<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionEmailLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_email_logs', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('subscription_id')->nullable();
			$table->bigInteger('post_id')->nullable()->index('post_id');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('updated_at')->nullable();
			$table->dateTime('mail_sent_on')->nullable();
			$table->text('error_details')->nullable();
			$table->enum('mail_status', array('yts','sent','error'))->default('yts');
			$table->index(['subscription_id','post_id','mail_status'], 'subscription_id');
			$table->unique(['subscription_id','post_id'], 'subscription_id_2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscription_email_logs');
	}

}
