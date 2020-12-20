<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lights', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('productname');
            $table->boolean('on')->default(false);
            $table->unsignedInteger('brightness')->nullable();
            $table->unsignedInteger('hue')->nullable();
            $table->unsignedInteger('saturation')->nullable();
            $table->boolean('reachable')->default(false);
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
        Schema::dropIfExists('lights');
    }
}
