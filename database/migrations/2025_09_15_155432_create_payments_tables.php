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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
        });
        
        Schema::create('status_payments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
        });

        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->integer('percent');
            $table->integer('fixed_amount')->default(0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->foreignId('commission_id')->nullable()->constrained('commissions')->onDelete('set null');
            $table->integer('net_amount');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->foreignId('status_id')->constrained('status_payments');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('status_payments');
        Schema::dropIfExists('commissions');
        Schema::dropIfExists('payments');
    }
};
