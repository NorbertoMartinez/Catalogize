<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemeBussinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme_bussinesses', function (Blueprint $table) {
            $table->id();

            $table->foreignId("bussiness_type_id")
                ->references("id")->on("bussiness_types");

            $table->foreignId("theme_id")
                ->references("id")->on("themes");

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
        Schema::dropIfExists('theme_bussinesses');
    }
}
