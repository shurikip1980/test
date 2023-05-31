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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Order::class)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Product::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('product_name')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_slug')->nullable();
            $table->string('image')->nullable();
            $table->string('type_img')->nullable();
            $table->integer('quantity')->unsigned()->default(0);
            $table->decimal('cost', 10, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
};
