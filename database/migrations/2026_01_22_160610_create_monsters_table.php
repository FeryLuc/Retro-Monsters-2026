<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('rarity');
            $table->integer('pv');
            $table->integer('attack');
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->integer('defense')->default(0);
            $table->unsignedInteger('rarety_id')->default(1);
            
            $table->foreign('rarety_id', 'FK_rarety')->references('id')->on('rareties')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('type_id', 'FK_type')->references('id')->on('monster_types')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monsters');
    }
}
