<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Channels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("playlist_id")->nullable();
            $table->string('name');
            $table->string('scheme')->index();
            $table->string('domain')->nullable()->index();
            $table->string("url",512)->index();
            $table->smallInteger("valid")->default(0)->index();
            $table->integer("check_count")->default(0);
            $table->integer("valid_count")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
