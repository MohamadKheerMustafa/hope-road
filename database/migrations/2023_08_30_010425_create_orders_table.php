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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('phoneNumber');
            $table->integer('telephone')->nullable();
            $table->string('notes')->nullable();
            $table->string('ipAddress');
            $table->tinyInteger('status')->default(0)->comment('0 => need handle , 1 => handling , 2 => done');
            $table->string('employeeNotes')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Employee who responsable for handling the order');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
