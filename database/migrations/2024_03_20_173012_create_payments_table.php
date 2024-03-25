<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
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
            $table->string('invoice_id')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('invoice_reference')->nullable();
            $table->string('created_date')->nullable();
            $table->text('comments')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('invoice_display_value')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('paid_currency')->nullable();
            $table->string('paid_currency_value')->nullable();
            $table->string('card_number')->nullable();
            $table->string('is_success')->nullable();
            $table->string('operation')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
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
}
