<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->string('topic_name');
            $table->string('slug');
            $table->text('description');
            $table->text('example_demo');
            $table->text('html_code');
            $table->text('css_code');
            $table->integer('sort');
            $table->text('js_code');
            $table->string('meta_title');
            $table->text('meta_description');
            $table->softDeletes();
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
        Schema::dropIfExists('tutorials');
    }
}
