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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('status', ['todo', 'in_progress', 'completed'])->nullable();
            $table->string('priority')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('assigned_by')->nullable();
            $table->string('progress_percent')->nullable();
            $table->text('daily_update')->nullable();
            $table->text('todo_work')->nullable();
            $table->text('pending_work')->nullable();
            $table->text('start_date')->nullable();
            $table->text('completed_at')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
