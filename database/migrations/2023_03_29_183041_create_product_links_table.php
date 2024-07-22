<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_links', function (Blueprint $table) {
            $table->id();


            $table->string("value");
            $table->string("description")->nullable();

            $table->foreignId("product_id")
                ->references("id")->on("products");

            $table->foreignId("link_type_id")
                ->references("id")->on("link_types");

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
        Schema::dropIfExists('product_links');
    }
}
