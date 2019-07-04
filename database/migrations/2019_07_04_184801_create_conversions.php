<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("client")->create('conversions', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->text('comment')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->unsignedInteger('old_status_id');
            $table->foreign('old_status_id')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');
            $table->unsignedInteger('new_status_id');
            $table->foreign('new_status_id')
                ->references('id')
                ->on('status')
                ->onDelete('cascade');
            $table->unsignedInteger('lead_id');
            $table->foreign('lead_id')
                ->references('id')
                ->on('leads')
                ->onDelete('cascade');
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
        Schema::connection("client")->dropIfExists('conversions');
    }
}
