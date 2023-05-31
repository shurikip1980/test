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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('type_img')->nullable();
            $table->string('slug');
            $table->integer('show_main')->default(0);
            $table->integer('show_home')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
        });

        Schema::create('new_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\News::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name')->nullable();
            $table->text('short_body')->nullable();
            $table->text('body')->nullable();
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
        Schema::dropIfExists('new_langs');
        Schema::dropIfExists('news');
    }
};
