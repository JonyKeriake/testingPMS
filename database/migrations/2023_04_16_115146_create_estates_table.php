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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('owner_id')->constrained('users')
                ->onDelete('cascade');

            $table->enum('estate_type' , ['land', 'apartment' , 'villa']);
            $table->enum('operation_type', ['sale','rent']);

            $table->enum('location' , ['Aleppo','Al-Ḥasakah','Al-Qamishli','Al-Qunayṭirah','Al-Raqqah','Al-Suwayda','Damascus','Darʿa','Dayr al-Zawr','Ḥamah','Homs','Idlib','Latakia' , 'Rif Dimashq']);

            $table->enum('locationInDamascus' , ['Ancient City (Old City)', 'Barzeh', 'Dummar', 'Jobar', 'Qanawat', 'Kafr Souseh', 'Mezzeh',
                'Al-Midan', 'Muhajreen', 'Qaboun', 'Qadam', 'Rukn ad-Din', 'Al-Salihiyah', 'Sarouja', 'Al-Shaghour', 'Yarmouk' , 'Jaramana'])->nullable() ;

            $table->text('description') ->nullable();


            $table->integer('price')->unsigned();
            $table->integer('space')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estates');
    }
};
