<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypeUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_type_units', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_type_id")->references("id")->on("product_types");
            $table->foreignId("unit_id")->references("id")->on("units");
            $table->foreignId("status_id")->references("id")->on("statuses");
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
        Schema::dropIfExists('product_type_units');
    }
}
