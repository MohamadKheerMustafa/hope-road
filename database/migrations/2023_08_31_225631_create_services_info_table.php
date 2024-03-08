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
        Schema::create('services_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('country');
            $table->string('durationOfCompletion');
            $table->string('serviceValidityPeriod');
            $table->text('details')->nullable();
            $table->string('price');
            $table->text('requiredPapers')->nullable();
            $table->text('paymentPrice');
            $table->string('entity');
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_info');
    }
};
