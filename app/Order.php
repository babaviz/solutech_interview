<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['order_number'];

    public function products(){
        return $this->belongsToMany(product::class,OrderDetail::class);
    }

    /**
     * @return product | null
     */
    public function product(){
        return $this->products()->first();
    }
}
