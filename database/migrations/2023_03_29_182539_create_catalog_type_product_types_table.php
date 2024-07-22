<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogTypeProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_type_product_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId("catalog_type_id")->references("id")->on("catalog_types");
            $table->foreignId("product_type_id")->references("id")->on("product_types");
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
        Schema::dropIfExists('catalog_type_product_types');
    }
}
