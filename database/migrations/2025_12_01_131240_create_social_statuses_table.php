<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hunter_id')->constrained('hunters')->cascadeOnDelete();
            $table->foreignId('organization_id')->nullable()->constrained('organizations');
            $table->string('job_title');
            $table->boolean('retiree')->default(false);
            $table->boolean('disabled')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_statuses');
    }
};
