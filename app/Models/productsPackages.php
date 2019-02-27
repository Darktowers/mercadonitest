<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsPackages extends Model
{
    //
    protected $table    = 'products_packages'; 
    protected $fillable = ['package_id','product_id'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    public $timestamps  = true;

    public function product()
    {
      return $this->belongsTo( \App\Models\Products::class, 'product_id' );
    }
}
