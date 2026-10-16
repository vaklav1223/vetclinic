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
    Schema::table('pets', function (Blueprint $table) {
        // Добавляем поле rating после поля age
        $table->integer('rating')->nullable()->after('age');
    });
    }

    public function down(): void
    {
    Schema::table('pets', function (Blueprint $table) {
        // Обязательно удаляем поле при откате
        $table->dropColumn('rating');
    });
    }

};
