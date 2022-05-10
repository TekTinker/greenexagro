<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('employee_id')->unsigned();
            $table->string('address')->nullable();
            $table->string('taluka')->nullable();
            $table->string('district')->nullable();
            $table->string('pin')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('employee_id')
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
        Schema::drop('employees');
    }
}
