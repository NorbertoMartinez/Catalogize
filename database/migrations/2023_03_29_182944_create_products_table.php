<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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

            $table->string("hash")->nullable();
            $table->longText("qr_code")->nullable();

            $table->string("name");
            $table->string("description")->nullable();

            $table->string("img")->nullable();
            $table->string("b2b_id");

            $table->foreignId("availability_id")
                ->references("id")->on("availabilities");

            $table->foreignId("product_type_id")
                ->references("id")->on("product_types");
//
//            $table->foreignId("unit_id")
//                ->references("id")->on("units");

            $table->foreignId("status_id")
                ->references("id")->on("statuses");


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
}
