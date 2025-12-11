<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('convictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hunter_id')->constrained('hunters')->cascadeOnDelete();
            $table->enum('status', ['unknown', 'yes', 'no']);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('convictions');
    }
};
