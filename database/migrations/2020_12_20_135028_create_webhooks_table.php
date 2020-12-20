<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('action_id')->nullable()->index();
            $table->foreignId('hue_id')->nullable()->index();
            $table->string('type');
            $table->string('name');
            $table->string('description');
            $table->string('token');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('action_id')->references('id')->on('actions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webhooks');
    }
}
