<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSupplierProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("supplier_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();//->default(DB::raw(('CURRENT_TIMESTAMP')));
            $table->foreign("supplier_id")
                ->references("id")
                ->on("suppliers")
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign("product_id")
                ->references("id")
                ->on("products")
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_products');
    }
}
