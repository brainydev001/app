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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('expense_note');
            $table->string('estimated_amount');
            $table->string('amount');
            $table->string('deviation');
            $table->boolean('is_approved')->default(false);
            $table->foreignId('approved_by')->nullable();
            $table->foreignId('rejected_by')->nullable();
            $table->string('examination_note');
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
        Schema::dropIfExists('expenses');
    }
};
