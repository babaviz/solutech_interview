<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable=['name','description','quantity'];

    public function suppliers(){
        return $this->belongsToMany(Supplier::class,supplierProduct::class);
    }

    public function supplier(){
        return $this->suppliers()->first();
    }

    public function orders(){
        return $this->belongsToMany(Order::class,OrderDetail::class);
    }
}
