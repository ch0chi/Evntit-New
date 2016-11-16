<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table) {
            $table->integer('user_id_to')->unsigned()->index();
            $table->integer('user_id_from')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
            $table->string('notification_info');
            $table->boolean('opened');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_notifications');
    }
}
