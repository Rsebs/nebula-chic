<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
  use HasFactory;

  protected $fillable = [
    'product_id',
    'amount',
    'user_id'
  ];
}
