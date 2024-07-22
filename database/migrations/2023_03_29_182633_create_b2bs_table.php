<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateB2bsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b2bs', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("fiscal_code")->nullable();
            $table->string("social_reason")->nullable();
            $table->string("slogan")->nullable();
            $table->string("img")->nullable();
            $table->string("telecom");
            $table->string("address");
//            $table->string("user_id")->nullable();
//            $table->string("responsable_user_id");

//            $table->foreignId("user_id")->references("id")->on("users");
            $table->foreignId("status_id")->references("id")->on("statuses");
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
        Schema::dropIfExists('b2bs');
    }
}
