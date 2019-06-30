<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sicks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stdcode',12)->unique()->index();
            $table->string('melicode',10)->unique()->nullable()->index();
            $table->string('fname',100)->nullable();
            $table->string('lname',100)->nullable();
            $table->string('fathername',100)->nullable();
            $table->string('email',100)->nullable();
            $table->unsignedInteger('major_id')->nullable()->index();  //foreign key/major
            $table->unsignedInteger('term_id')->nullable()->index();  //foreign key/term
            $table->string('phone',11)->nullable();
            $table->string('cellphone',11)->nullable();
            $table->string('address',1000)->nullable();
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
        Schema::dropIfExists('sicks');
    }
}
