<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Order;
use App\product;
use App\Supplier;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function summary(Request $request){
        return response()->json([
           "summary"=>[
               [
                   "title"=>"suppliers",
                   "value"=>Supplier::all()->count()
               ],
               [
                   "title"=>"products",
                   "value"=>product::all()->count()
               ],
               [
                   "title"=>"orders",
                   "value"=>Order::all()->count()
               ]
           ]
        ]);
    }

    public function suppliers(Request $request){
        $suppliers=Supplier::all();
        for ($s=0;$s<$suppliers->count();$s++){
            $suppliers[$s]->prod_count=$suppliers[$s]->products->count();
        }

        return response()->json(["suppliers"=>$suppliers]);
    }

    public function products(Request $request){
        $products=product::all();
        for ($i=0;$i<$products->count();$i++){
            $products[$i]->supplier=$products[$i]->supplier();
        }
        return response()->json(["products"=>$products]);
    }

    public function orders(Request $request){
        $orders=Order::all();
        for ($o=0;$o<$orders->count();$o++){
            $orders[$o]->detail=$orders[$o]->products->count();
        }
        return response()->json(["orders"=>$orders]);
    }

    public function supplier($id){
        $supplier=Supplier::query()->find($id);
        if($supplier)
            $supplier->products;

        return response()->json(['supplier'=>$supplier]);
    }

    public function order($id){
        $order=Order::query()->find($id);
        if($order) {
            $order->products;
            for ($i=0;$i<$order->products->count();$i++){
                $order->products[$i]->supplier=$order->products[$i]->supplier();
            }
        }

        return response()->json(['order'=>$order]);
    }
}
