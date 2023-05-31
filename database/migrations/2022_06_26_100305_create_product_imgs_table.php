<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_imgs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('type_img')->nullable();
            $table->integer('main_img')->default(0);
            $table->integer('numeral')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_imgs');
    }
};
