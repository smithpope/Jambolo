<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('artisan_id')->foreign_key();
            $table->string('product_Name');
            $table->enum('Category', ['Entatainment Unit', 'Planner', 'Electrician', 'Furniture'
            , 'Promotions']);
            $table->text('description');
            $table->float("amount");
            //$table->string('product_picture');
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
        Schema::dropIfExists('products');
    }
};
