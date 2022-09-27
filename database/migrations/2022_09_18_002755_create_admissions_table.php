<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
                $table->id();
                $table->string('student_id')->nullable();
                $table->string('user_name')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('email')->unique()->nullable();
                $table->string('mobile')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->string('present_address')->nullable();
                $table->string('permanent_address')->nullable();
                $table->string('gender')->nullable();
                $table->date('dob')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->integer('class_id')->nullable();
                $table->integer('section_id')->nullable();
                $table->integer('year_id')->nullable();
                $table->integer('course_id')->nullable();
                $table->string('scholarship')->nullable();
                $table->string('father_name')->nullable();
                $table->string('father_occupation')->nullable();
                $table->string('mother_name')->nullable();
                $table->string('mother_occupation')->nullable();
                $table->string('nid_number')->nullable();
                $table->string('gurdian_mobile')->nullable();
                $table->string('school_collage')->nullable();
                $table->string('blood_group')->nullable();
                $table->string('admission_fee')->nullable();
                $table->string('discount')->nullable();
                $table->string('messege')->nullable();
                $table->string('student_image')->nullable();
                $table->string('gurdian_image')->nullable();
                $table->string('admission_date')->nullable();
                $table->string('religion')->nullable();
                $table->string('about')->nullable();
                $table->string('Pass_code')->nullable();
                $table->string('status')->comment('active,inactive')->nullable();
                $table->string('last_login')->nullable();
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
        Schema::dropIfExists('admissions');
    }
}
