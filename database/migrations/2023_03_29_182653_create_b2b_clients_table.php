<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateB2bClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b2b_clients', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->references("id")->on("users");
            $table->foreignId("b2b_id")->references("id")->on("b2bs");
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
        Schema::dropIfExists('b2b_clients');
    }
}
