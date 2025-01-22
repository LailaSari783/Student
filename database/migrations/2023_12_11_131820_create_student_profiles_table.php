<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'student_profiles',
            function (Blueprint $table) {

                $table->id();
                $table->string('name');
                $table->enum(
                    'gender',
                    [
                        'male',
                        'female'
                    ]
                );
                $table->string('phone_number')->unique();
                $table->string('matric_number')->unique();
                $table->text('address')->nullable();
                $table->integer('age');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_profiles');
    }
};
