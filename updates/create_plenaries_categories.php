<?php namespace Kitsoft\Plenary\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePlenariesCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_plenary_plenaries_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('plenary_id')->index();
            $table->integer('category_id')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_plenary_plenaries_categories');
    }
}
