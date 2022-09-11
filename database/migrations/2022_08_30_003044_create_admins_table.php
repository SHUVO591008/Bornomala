<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('unique_id')->nullable();
                $table->string('user_name')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('Fname')->nullable();
                $table->string('Mname')->nullable();
                $table->string('gender')->nullable();
                $table->string('image')->nullable();
                $table->string('religion')->nullable();
                $table->string('id_no')->nullable();
                $table->date('dob')->nullable();
                $table->string('join_date')->nullable();
                $table->string('mobile')->nullable();
                $table->string('Pass_code')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2')->nullable();
                $table->string('city')->nullable();
                $table->string('status')->comment('active,inactive,banned')->nullable();
                $table->string('last_login')->nullable();
                $table->string('email')->unique()->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->nullable();
                $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
