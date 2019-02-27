<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productsPackages extends Model
{
    //
    protected $table    = 'productsPackages'; 
    protected $fillable = ['package_id','product_id'];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at'];

    public $timestamps  = true;

    public function products()
    {
      return $this->hasMany( \App\Models\products::class, 'productId' );
    }
}
