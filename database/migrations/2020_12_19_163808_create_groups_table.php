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
            $table->string('name');
            $table->string('type');
            $table->string('class')->nullable();
            $table->boolean('all_on')->default(false);
            $table->boolean('any_on')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('group_light', function (Blueprint $table) {
            $table->foreignId('group_id');
            $table->foreignId('light_id');
            $table->primary(['group_id', 'light_id']);

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('light_id')->references('id')->on('lights')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_light');
        Schema::dropIfExists('groups');
    }
}
