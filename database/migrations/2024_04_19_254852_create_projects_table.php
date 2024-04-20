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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->text('description');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'finished', 'rejected'])->default('pending');
            
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('budget_id');
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
