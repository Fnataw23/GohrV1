<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hunters', function (Blueprint $table) {
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('phone');
            $table->string('email');
            $table->char('snils', 14);
            $table->boolean('mn')->default(false);
            $table->text('comment')->nullable();
            $table->foreignId('organization_id')->nullable()->constrained('organizations');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hunters');
    }
};
