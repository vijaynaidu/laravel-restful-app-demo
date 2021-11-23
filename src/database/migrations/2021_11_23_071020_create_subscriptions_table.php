<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriptions', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('website_id')->nullable();
			$table->string('email')->nullable();
			$table->string('name')->nullable();
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('updated_at')->nullable();
			$table->string('activation_code')->nullable();
			$table->enum('subscription_status', array('activation_required','subscribed','un_subscribed'))->default('activation_required');
			$table->index(['email','activation_code'], 'email');
			$table->index(['website_id','subscription_status'], 'website_id');
			$table->unique(['website_id','email'], 'website_id_2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscriptions');
	}

}
