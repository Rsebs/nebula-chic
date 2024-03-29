<?php

use App\Models\Product;
use App\Models\User;
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
    Schema::create('purchases', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Product::class);
      $table->foreign('product_id')->references('id')->on('products');
      $table->integer("amount");
      $table->foreignIdFor(User::class);
      $table->foreign('user_id')->references('id')->on('users');
      $table->boolean("delivery_status")->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('purchases');
  }
};
