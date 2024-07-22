<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_data', function (Blueprint $table) {
            $table->id();


            $table->string("variable")->nullable();
            $table->string("name")->nullable();
            $table->longText("description")->nullable();
            $table->string("sku")->nullable();
            $table->boolean("isStockeable")->default(0);
            $table->integer("stock")->nullable();
            $table->boolean("isGlobalPrice")->default(0);
            $table->double("price")->nullable();

            $table->foreignId("availability_id")
                ->references("id")->on("availabilities");

            $table->foreignId("status_id")
                ->references("id")->on("statuses");

            $table->foreignId("product_id")
                ->references("id")->on("products");

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
        Schema::dropIfExists('product_data');
    }
}
