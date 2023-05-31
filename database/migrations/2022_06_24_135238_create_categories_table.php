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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('type_img')->nullable();
            $table->integer('show_main')->default(0);
            $table->integer('show_home')->default(0);
            $table->integer('constant')->default(0);
            $table->integer('active')->default(1);
            $table->integer('numeral')->default(0);
            $table->timestamps();
        });

        Schema::create('category_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Category::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name')->nullable();
            $table->text('body')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
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
        Schema::dropIfExists('category_langs');
        Schema::dropIfExists('categories');
    }
};
