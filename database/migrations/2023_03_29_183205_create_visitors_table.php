<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();

//            $table->integer("resource_id")->nullable();
//            $table->string("resource_type")->nullable();
            $table->string("location")->nullable();
            $table->string("timezone");
            $table->string("referer");
            $table->integer("time_active");
            $table->string("hot_zones")->nullable();
            $table->integer("clicks");
            $table->boolean("isGuest")->default(1);


            $table->foreignId("view_builder_id")
                ->references("id")->on("view_builders");

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
        Schema::dropIfExists('visitors');
    }
}
