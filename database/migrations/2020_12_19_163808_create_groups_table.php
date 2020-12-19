<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hue_id')->nullable()->index();
            $table->string('name');
            $table->string('type');
            $table->string('class')->nullable();
            $table->boolean('all_on')->default(false);
            $table->boolean('any_on')->default(false);
            $table->timestamps();
        });

        Schema::create('group_light', function (Blueprint $table) {
            $table->foreignId('group_id');
            $table->foreignId('light_id');
            $table->primary(['group_id', 'light_id']);

            $table->foreign('group_id')->references('hue_id')->on('groups')->onDelete('cascade');
            $table->foreign('light_id')->references('hue_id')->on('lights')->onDelete('cascade');
        });

        // Schema::create('group_sensor', function (Blueprint $table) {
        //     $table->foreignId('group_id');
        //     $table->foreignId('sensor_id');
        //     $table->primary(['group_id', 'sensor_id']);

        //     $table->foreign('group_id')->references('hue_id')->on('groups')->onDelete('cascade');
        //     $table->foreign('sensor_id')->references('hue_id')->on('sensors')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_sensor');
        Schema::dropIfExists('group_light');
        Schema::dropIfExists('groups');
    }
}
