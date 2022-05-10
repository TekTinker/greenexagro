<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('carts', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('cart_id')->unsigned();
            $table->integer('total_items');
            $table->integer('total_price');
            $table->timestamps();

            $table->foreign('cart_id')
                ->references('id')
                ->on('users')
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
        Schema::drop('carts');
    }
}
