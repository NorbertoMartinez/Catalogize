<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->longText("description");
            $table->double("price_per_month");
            $table->double("price_per_year")->nullable();
            $table->double("discount")->nullable();
            $table->string("image")->nullable();
            $table->integer("catalogs_per_plan")->default(0);
            $table->integer("brochures_per_plan")->default(0);
            $table->integer("sections_per_plan")->default(0);
            $table->integer("products_per_plan")->default(0);
            $table->integer("isReportable")->default(0);
            $table->integer("isMarketing")->default(0);
            $table->integer("isMessageCenter")->default(0);

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
        Schema::dropIfExists('plans');
    }
}
