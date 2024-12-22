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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reporter_id')->constrained('users');  // ID pengguna yang melaporkan
            $table->foreignId('reported_post_id')->nullable()->constrained('posts');  // ID Postingan yang dilaporkan
            $table->foreignId('reported_user_id')->nullable()->constrained('users');  // ID User yang dilaporkan
            $table->enum('category', ['Spam', 'Inappropriate', 'Harassment', 'Fake News', 'Other']); // Kategori laporan
            $table->text('description');
            $table->enum('status', ['Pending', 'Reviewed', 'Action Taken'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
