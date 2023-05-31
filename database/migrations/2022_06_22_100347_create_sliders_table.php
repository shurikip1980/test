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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->string('link')->nullable();
            $table->string('image')->nullable();
            $table->string('type_img')->nullable();
            $table->integer('show_main')->default(0);
            $table->timestamps();
        });

        Schema::create('slider_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Slider::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->text('short_body')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_langs');
        Schema::dropIfExists('sliders');
    }
};
