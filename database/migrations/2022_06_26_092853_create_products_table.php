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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->string('slug', 255);
            $table->string('code', 255)->nullable();
            $table->integer('show_main')->default(0);
            $table->integer('popular')->default(0);
            $table->integer('in_stock')->default(0);
            $table->integer('new')->default(0);
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('price_old', 10, 2)->default(0);
            $table->foreignIdFor(\App\Models\Currency::class)
                ->constrained()
                ->onDelete('cascade');
            $table->integer('count_product')->default(0);
            $table->text('alike')->nullable();
            $table->text('delivery')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name')->nullable();
            $table->text('specification')->nullable();
            $table->text('short_body')->nullable();
            $table->text('body')->nullable();
            $table->text('characteristics')->nullable();
            $table->text('shipping_payment')->nullable();
            $table->text('info')->nullable();
            $table->string('info_img', 30)->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_keywords', 255)->nullable();
            $table->text('meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_langs');
        Schema::dropIfExists('products');
    }
};
