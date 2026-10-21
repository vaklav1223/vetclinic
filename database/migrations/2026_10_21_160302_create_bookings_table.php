<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('pet_id')->constrained()->onDelete('cascade');
        
        $table->string('phone');      
        $table->text('comment')->nullable();  
        $table->string('status')->default('new'); 
        
        $table->timestamps();  
    });
}

};
