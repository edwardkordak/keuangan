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
        Schema::create('document_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents')->onDelete('cascade');
            $table->foreignId('workflow_id')->constrained('document_workflows')->onDelete('cascade');
            $table->boolean('is_checked')->default(false);
            $table->timestamp('checked_at')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('checked_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();

            $table->unique(['document_id', 'workflow_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_progress');
    }
};
