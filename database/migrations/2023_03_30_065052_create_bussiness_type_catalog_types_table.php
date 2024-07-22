<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBussinessTypeCatalogTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bussiness_type_catalog_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId("bussiness_type_id")
                ->references("id")->on("bussiness_types");

            $table->foreignId("catalog_type_id")
                ->references("id")->on("catalog_types");

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
        Schema::dropIfExists('bussiness_type_catalog_types');
    }
}
