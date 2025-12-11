<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Запуск миграции.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hunter_id')->constrained('hunters')->onDelete('cascade'); // Внешний ключ на таблицу hunters
            $table->string('postal_code');
            $table->string('region');
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('building')->nullable(); // Можно не заполнять
            $table->string('apartment')->nullable(); // Можно не заполнять
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Откат миграции.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
