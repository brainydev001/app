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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('age');
            $table->string('email')->nullable();
            $table->string('county');
            $table->string('sub_county');
            $table->foreignId('region_id')->nullable();
            $table->foreignId('constituency_id')->nullable();
            $table->foreignId('ward_id')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('type_id');
            $table->timestamp('last_seen')->nullable();
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
