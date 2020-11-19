<?php

use App\Enums\TransactionStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('no action');
            $table->foreignId('stripe_setting_id')->constrained()->onUpdate('cascade')->onDelete('no action');
            $table->string('ref_no', 255)->unique();
            $table->decimal('amount', 30, 4)->default(0);
            $table->string('currency', 5);
            $table->string('return_url', 255);
            $table->string('callback_url', 255);
            $table->json('meta')->nullable();
            $table->json('payment_response')->nullable();
            $table->json('callback_response')->nullable();
            $table->ipAddress('ip_address');
            $table->string('user_agent');
            $table->unsignedSmallInteger('status')->default(TransactionStatus::Pending);
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
        Schema::dropIfExists('transactions');
    }
}
