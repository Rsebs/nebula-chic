<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'price',
    'description',
    'product_type_id',
  ];

  /**
   * Relationship One to Many (Inverse)
   * 
   * @return Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function productType()
  {
    return $this->belongsTo(ProductType::class);
  }

  /**
   * Relationship One to Many
   * 
   * @return Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function images()
  {
    return $this->hasMany(Image::class);
  }

  /**
   * Relationship Many to Many
   * 
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function sizes()
  {
    return $this->belongsToMany(Size::class);
  }
}
