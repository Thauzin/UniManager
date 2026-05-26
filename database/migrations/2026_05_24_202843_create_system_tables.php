<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | COURSE AREAS
        |--------------------------------------------------------------------------
        */

        Schema::create('course_areas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | COURSE PERIODS
        |--------------------------------------------------------------------------
        */

        Schema::create('course_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | COURSES
        |--------------------------------------------------------------------------
        */

        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->text('description');
            $table->integer('workload')->nullable();

            $table->foreignId('course_area_id')
                ->constrained('course_areas');

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        */

        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('ra')->unique();

            $table->foreignId('user_id')
                ->constrained('users');

            $table->foreignId('course_id')
                ->constrained('courses');

            $table->dateTime('course_start');
            $table->dateTime('course_end');

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | SUBJECTS
        |--------------------------------------------------------------------------
        */

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamp('start_date');
            $table->timestamp('end_date');

            $table->integer('workload');

            $table->foreignId('user_id')
                ->constrained('users');

            $table->foreignId('course_period_id')
                ->constrained('course_periods');

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | COURSE SUBJECT
        |--------------------------------------------------------------------------
        */

        Schema::create('course_subject', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses');

            $table->foreignId('subject_id')
                ->constrained('subjects');

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | CLASSES
        |--------------------------------------------------------------------------
        */

        Schema::create('classes', function (Blueprint $table) {
            $table->id();

            $table->date('date');

            $table->string('name');

            $table->text('description');

            $table->foreignId('subject_id')
                ->constrained('subjects');

            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | FREQUENCIES
        |--------------------------------------------------------------------------
        */

        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();

            $table->double('percentage');

            $table->foreignId('class_id')
                ->constrained('classes');

            $table->foreignId('student_id')
                ->constrained('students');

            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('frequencies');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('course_subject');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('students');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_periods');
        Schema::dropIfExists('course_areas');
    }
};