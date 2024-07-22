<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_sections', function (Blueprint $table) {
            $table->id();

            $table->foreignId("catalog_id")
                ->references("id")
                ->on("catalogs")
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId("section_id")
                ->references("id")
                ->on("sections")
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('catalog_sections');
    }
}
