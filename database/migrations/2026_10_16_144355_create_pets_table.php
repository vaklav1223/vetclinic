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
    Schema::create('pets', function (Blueprint $table) {
        $table->id();

        // Внешний ключ на таблицу owners (id владельца)
        $table->foreignId('owner_id')->constrained('owners')->onDelete('cascade');

        // Поля из config/catalog.php (пример стандартного набора)
        $table->string('title'); // Кличка
        $table->string('breed')->nullable(); // Порода (минимум одно nullable)
        $table->integer('age')->default(0); // Возраст (минимум одно с default)

        // Специальные типы по заданию
        $table->decimal('price', 10, 2); // деньги — decimal
        $table->boolean('is_vaccinated')->default(false); // да/нет — boolean
        $table->date('birth_date')->nullable(); // даты — date

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('pets');
}

};
