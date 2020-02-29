<?php

use App\Order;
use App\OrderDetail;
use App\product;
use App\Supplier;
use App\supplierProduct;
use App\User;
use Bezhanov\Faker\ProviderCollectionHelper;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\Factory::create();
        ProviderCollectionHelper::addAllProvidersTo($faker);

        //create user
        User::query()->create(
            [
                'name'=>$faker->name,
                'email'=>'test@email.com',
                'password'=>bcrypt('secret')
            ]
        );

        //generate suppliers
        for ($i=0;$i<5;$i++){
            Supplier::query()->create(['name'=>$faker->company]);
        }

        //generate products
        for ($i=0;$i<50;$i++){
            product::query()->create([
                'name'=>$faker->productName,
                'description'=>$faker->department,
                'quantity'=>$faker->numberBetween(5,1000)
            ]);
        }

        //supplier products
        $products=product::all();
        $suppliers=Supplier::all();

        for ($i=0;$i<$products->count();$i++){
            $prod_id=$products[$i]->id;
            $supplier_id=rand(1,$suppliers->count());

            supplierProduct::query()->create([
               'product_id'=>$prod_id,
               "supplier_id"=>$supplier_id
            ]);
        }

        //generate orders
        for ($i=0;$i<100;$i++){
            Order::query()->create(['order_number'=>'ODR'.sprintf('%04s',$i+300)]);
        }

        //order details
        $orders=Order::all();
        for ($o=0;$o<$orders->count();$o++){

            for ($i=0;$i<rand(1,8);$i++) {
                $prod_id = rand(1, $products->count());
                $order_id = $orders[$o]->id;

                OrderDetail::query()->create([
                    'product_id' => $prod_id,
                    "order_id" => $order_id
                ]);
            }
        }
    }
}
