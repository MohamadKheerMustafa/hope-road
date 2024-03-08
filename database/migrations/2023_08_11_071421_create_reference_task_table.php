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
        Schema::create('reference_task', function (Blueprint $table) {
            $table->unsignedBigInteger('reference_id');
            $table->unsignedBigInteger('task_id');
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->primary(['reference_id', 'task_id']);
            $table->boolean('done')->default(0)->comment('0 => Not Ready yet , 1 => done'); // Reference task.
            $table->string('by_Who')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_task');
    }
};
