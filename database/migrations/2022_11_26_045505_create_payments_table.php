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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('balance');
            $table->timestamp('due_date')->nullable();
            $table->foreignId('activity_id')->nullable();
            $table->foreignId('event_id')->nullable();
            $table->foreignId('expense_id')->nullable();
            $table->foreignId('module_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->string('payment_note');
            $table->boolean('is_approved')->default(false);
            $table->foreignId('approved_by')->nullable();
            $table->foreignId('rejected_by')->nullable();
            $table->string('examination_note');
            $table->string('transaction_code');
            $table->string('payment_method');
            $table->foreignId('relation_id');
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
        Schema::dropIfExists('payments');
    }
};
