<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_menus', function (Blueprint $table) {
            $table->id('MenuID');
            $table->string('MenuName')->unique();
            $table->text('MenuDescription');
            $table->decimal('MenuPrice', 12, 2)->unsigned()->nullable()->default(0);
            $table->integer('CategoryID')->unsigned();
            $table->boolean('isActive')->default(true);
            $table->timestamps();

            //foreign key            
            $table->foreign('CategoryID')->references('CategoryID')->on('tbl_categories');
            // ->onDelete('cascade')

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_menus');
    }
}
