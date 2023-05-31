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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->nestedSet();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->enum('type',['main', 'other', 'services', 'footer']);
            $table->integer('active')->default(1);
            $table->timestamps();
        });

        Schema::create('page_langs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Page::class)
                ->constrained()
                ->onDelete('cascade');
            $table->string('lang', 5)->nullable();
            $table->string('name')->nullable();
            $table->text('short_body')->nullable();
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
        Schema::dropIfExists('page_langs');
        Schema::dropIfExists('pages');
    }
};
