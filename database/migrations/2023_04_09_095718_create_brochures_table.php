<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrochuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brochures', function (Blueprint $table) {
            $table->id();
            $table->string("title", 50);
            $table->string("subtitle", 50)->nullable();
            $table->longText("description", 200)->nullable();


            $table->longText("resource", 300)->nullable(); // video / image / model
            $table->longText("pattern")->nullable();
            $table->longText("pattern_img")->nullable();

            $table->integer("scale")->default(1);
            $table->integer("radials")->default(0);


            $table->boolean("isExternalPattern")->default(false);

            $table->boolean("isLink")->default(false);
            $table->string("link", 200)->nullable();

            $table->boolean("isPlayable")->default(false);
            $table->boolean("isSoundable")->default(false);


            $table->integer("status_id")->default(1);

            $table->integer("b2b_id");
            $table->integer("brochure_serie_id")->nullable();

            $table->string("hash", 100)->nullable();
            $table->longText("qr_code")->nullable();
            $table->timestamps();

            $table->foreignId("brochure_type_id")
                ->references("id")
                ->on("brochure_types")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brochures');
    }
}
