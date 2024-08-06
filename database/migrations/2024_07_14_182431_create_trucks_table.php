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
    Schema::create('trucks', function (Blueprint $table) {
      $table->id();
      $table->string('marca');
      $table->string('placa')->unique();
      $table->string('dueno')->nullable();
      $table->integer('tolerancia_delantera')->nullable();
      $table->integer('tolerancia_trasera')->nullable();
      $table->text('observation')->nullable();
      $table->string('user_name_insert');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('trucks');
  }
};
