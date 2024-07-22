<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();


            $table->string("hash")->nullable();
            $table->string("background")->nullable();
            $table->longText("qr_code")->nullable();
            $table->longText("ar_code")->nullable();
            $table->string("title");
            $table->string("subtitle")->nullable();
            $table->longText("description")->nullable();

            $table->foreignId("status_id")
                ->references("id")
                ->on("statuses");



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
        Schema::dropIfExists('sections');
    }
}
