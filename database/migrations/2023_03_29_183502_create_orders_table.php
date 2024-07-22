<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string("total_string");
            $table->string("order_type");
            $table->string("promotional_code_id")->nullable();


            $table->foreignId("user_id")
                ->references("id")->on("users");

            $table->foreignId("plan_id")
                ->references("id")->on("plans");

            $table->foreignId("status_id")
                ->references("id")->on("cart_statuses");

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
        Schema::dropIfExists('orders');
    }
}
