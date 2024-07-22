<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypeFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_type_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_type_id")->references("id")->on("product_types");
            $table->foreignId("feature_id")->references("id")->on("features");
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
        Schema::dropIfExists('product_type_features');
    }
}
