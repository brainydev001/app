<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->foreignId('staff_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->foreignId('user_id');
            $table->foreignId('attachment_id')->nullable();
            $table->string('county');
            $table->string('sub_county');
            $table->foreignId('constituency_id');
            $table->foreignId('region_id');
            $table->foreignId('ward_id');
            $table->foreignId('created_by');
            $table->foreignId('updated_by');
            $table->boolean('is_approved')->default(false);
            $table->foreignId('approved_by')->nullable();
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
        Schema::dropIfExists('events');
    }
};
