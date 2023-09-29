<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('billed_to')->nullable();
            $table->string('address')->nullable();
            $table->string('gstin')->nullable();
            $table->longText('complex_data')->nullable();
            $table->string('hsn')->nullable();
            $table->string('trip_total')->nullable();
            $table->string('remark')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('total_advance')->nullable();
            $table->string('balance_amount')->nullable();
            $table->string('amount_in_words')->nullable();
            $table->string('net_payble_amount')->nullable();
            $table->string('reverse_charge')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('pancard_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
