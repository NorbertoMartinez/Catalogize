<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSpecificationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_specification_items', function (Blueprint $table) {
            $table->id();

            $table->string("tittle");
            $table->longText("description");
            $table->string("link1")->nullable();
            $table->string("link2")->nullable();
            $table->string("action")->nullable();


            $table->foreignId("product_specification_id")
                ->references("id")->on("specification_types");

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
        Schema::dropIfExists('product_specification_items');
    }
}
