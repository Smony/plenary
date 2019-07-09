<?php namespace Kitsoft\Plenary\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePlenariesTestTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_plenary_plenaries_test', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('kitsoft_plenary_categories');
            $table->index(['slug', 'category_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_plenary_plenaries_test');
    }
}
