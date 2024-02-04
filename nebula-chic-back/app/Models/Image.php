<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
  use HasFactory;

  protected $fillable = [
    'path',
    'product_id',
  ];

  /**
   * Relationship One to Many (Inverse)
   * 
   * @return Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
