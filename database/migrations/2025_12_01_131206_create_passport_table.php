<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hunter_id')->constrained('hunters')->cascadeOnDelete();
            $table->string('series');
            $table->string('number');
            $table->date('issue_date');
            $table->string('issuer');
            $table->string('unit_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passports');
    }
};
