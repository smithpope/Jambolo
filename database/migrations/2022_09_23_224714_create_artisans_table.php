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
        Schema::create('artisans', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('business_name');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->string('category_id');
            $table->enum('association',['EKO NASHCO', 'LASSMA', 'LSETF', 'NARAP', 'PCFA', 
            'PECAN', 'Plumbers Association', 'Independent Operators', 'LSETF Graduates']);
            $table->string('bank_name');
            $table->string('account_number');
            $table->enum('bank', ['Access', 'Access Diamond', 'Fidelity', 'Eco Bank', 
            'GTB','Polaris', 'UBA', 'Union', 'Kuda']);
            $table->string('passport');
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
        Schema::dropIfExists('artisans');
    }
};
