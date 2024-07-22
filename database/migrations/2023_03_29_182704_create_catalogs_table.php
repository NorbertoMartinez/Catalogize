<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();

            $table->longText("hash")->nullable();
            $table->longText("background")->nullable();
            $table->string("theme")->nullable();
            $table->longText("qr_code")->nullable();
            $table->string("name");
            $table->string("subtitle")->nullable();
            $table->string("description")->nullable();
            $table->foreignId("b2b_id")
                ->references("id")->on("b2bs");
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
        Schema::dropIfExists('catalogs');
    }
}
