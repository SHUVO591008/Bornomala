<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_advertises', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('des')->nullable();
            $table->string('position')->nullable();
            $table->string('image')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('btn')->nullable()->comment('on And off');
            $table->string('status')->nullable()->comment('0=Inactive And 1=Active');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('course_advertises');
    }
}
