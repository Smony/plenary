<?php namespace Kitsoft\Plenary\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreatePlenarySessionsTable extends Migration
{
    public function up()
    {
        Schema::create('kitsoft_plenary_plenary_sessions', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('date_refresh')->nullable();
            $table->string('name_session')->nullable();
            $table->string('number')->nullable();
            $table->string('number_session')->nullable();
            $table->integer('convocation_id')->unsigned()->index()->nullable();
            $table->integer('meetingtype_id')->unsigned()->index()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitsoft_plenary_plenary_sessions');
    }
}
