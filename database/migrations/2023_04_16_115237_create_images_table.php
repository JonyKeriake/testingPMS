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
        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->enum('property_type' , ['estate' , 'car']) ;
            $table->foreignId('car_id')->constrained('cars')->nullable()
                ->onDelete('cascade');;
            $table->foreignId('estate_id')->constrained('estates')->nullable()
                ->onDelete('cascade');;
            $table->string('image') ;

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
