<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table    = 'products'; 
    protected $fillable = ['name','reference', 'price', 'cost', 'quantity', 'active'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    public $timestamps  = true;

    public function subProducts()
    {
      return $this->hasMany( \App\Models\ProductsPackages::class, 'package_id' );
    }
}
