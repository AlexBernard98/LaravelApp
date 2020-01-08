<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('orderdate');
            $table->string('username');
            $table->string('firstname');
            $table->string('surname');
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->string('city');
            $table->string('county');
            $table->string('postcode');
            $table->decimal('ordertotal', 5, 2);
            $table->string('orderdetails');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
