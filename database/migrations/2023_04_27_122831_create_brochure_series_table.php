<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrochureSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brochure_series', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->longText("description")->nullable();
            $table->longText("b2b_id");
            $table->integer("status_id")->default(1);

            $table->string("hash")->nullable();
            $table->longText("qr_code")->nullable();

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
        Schema::dropIfExists('brochure_series');
    }
}
