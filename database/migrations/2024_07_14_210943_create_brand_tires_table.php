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
    Schema::create('brand_tires', function (Blueprint $table) {
      $table->id();
      $table->string('nombre')->unique();
      $table->string('modelo');
      $table->string('user_name_insert');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('brand_tires');
  }
};
