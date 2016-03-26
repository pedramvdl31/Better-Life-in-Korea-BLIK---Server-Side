<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('cat_id');
            $table->integer('subcat_id');
            $table->string('title');
            $table->string('city');
            $table->decimal('lat', 9, 6)->nullable();
            $table->decimal('long', 9, 6)->nullable();
            $table->text('description');
            $table->text('file_srcs')->nullable();
            $table->integer('views')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->softDeletes();
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
        Schema::drop('ads');
    }
}
