<?php namespace Kitsoft\Plenary\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateDeputiesTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_plenary_deputies', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('person_id')->unsigned()->index()->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_plenary_deputies');
    }
}
