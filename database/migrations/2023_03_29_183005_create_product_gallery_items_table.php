<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGalleryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_gallery_items', function (Blueprint $table) {
            $table->id();


            $table->string("resource");
            $table->string("name");
            $table->longText("description")->nullable();
//            $table->integer("gallery_resource_type_id");
            $table->string("trigger")->nullable();


            $table->foreignId("product_gallery_id")
                ->references("id")->on("product_galleries");

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
        Schema::dropIfExists('product_gallery_items');
    }
}
