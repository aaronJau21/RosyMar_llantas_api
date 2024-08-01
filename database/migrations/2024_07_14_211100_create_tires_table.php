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
    Schema::create('tires', function (Blueprint $table) {
      $table->id();
      $table->integer('posicion')->default(1);
      $table->string('KM_actutal');
      $table->foreignId('brand_id')->constrained('brand_tires')->cascadeOnDelete();
      $table->foreignId('trucks_id')->constrained('trucks')->cascadeOnDelete();
      $table->string('modelo');
      $table->string('medida');
      $table->integer('R1');
      $table->integer('R2');
      $table->integer('R3');
      $table->enum('estado', ['I', 'N', 'R']);
      $table->string('user_name_insert');
      $table->text('observaciones')->nullable();
      $table->integer('presion_aire')->nullable();
      $table->string('accion')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tires');
  }
};
