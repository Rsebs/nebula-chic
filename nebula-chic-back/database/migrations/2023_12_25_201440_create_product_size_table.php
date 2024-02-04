<?php

use App\Models\Product;
use App\Models\Size;
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
    Schema::create('product_size', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Product::class);
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
      $table->foreignIdFor(Size::class);
      $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade')->onUpdate('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('product_size');
  }
};
