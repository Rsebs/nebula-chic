<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'cod',
  ];

  /**
   * Relationship Many to Many
   *
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function products(): BelongsToMany
  {
    return $this->belongsToMany(Product::class);
  }
}
