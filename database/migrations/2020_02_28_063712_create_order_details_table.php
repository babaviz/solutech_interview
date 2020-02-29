<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("order_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();//->default(DB::raw(('CURRENT_TIMESTAMP')));

            $table->foreign('order_id')
                ->references('id')
                ->on("orders")
                ->onUpdate("cascade")
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on("products")
                ->onUpdate("cascade")
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
