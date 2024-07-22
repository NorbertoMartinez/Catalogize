<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewBuildersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_builders', function (Blueprint $table) {
            $table->id();

            $table->string("url");
            $table->text("hash");
            $table->boolean("isQR")->default(1);

            $table->foreignId("catalog_id")
                ->references("id")->on("catalogs");

            $table->foreignId("status_id")
                ->references("id")->on("viewer_statuses");

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
        Schema::dropIfExists('view_builders');
    }
}
