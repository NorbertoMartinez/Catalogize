<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPriceTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_price_taxes', function (Blueprint $table) {
            $table->id();

            $table->double("tax");
            $table->boolean("isFiscal")->default(false);

            $table->foreignId("product_price_id")
                ->references("id")->on("product_prices");

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
        Schema::dropIfExists('product_price_taxes');
    }
}
