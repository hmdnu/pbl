<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumni_surveys', function (Blueprint $table) {
            $table->id();
            $table->string('student_nim');
            $table->foreign('student_nim')->references('nim')->on('students');

            $table->unsignedBigInteger('profession_id');
            $table->foreign('profession_id')->references('id')->on('professions');

            $table->string('phone');
            $table->string('email');
            $table->date('first_work_date');
            $table->integer('waiting_period');

            $table->string('institution_type');
            $table->string('institution_name');
            $table->string('institution_location');
            $table->date('first_institution_work_date');

            $table->string('supervisor_name');
            $table->string('supervisor_position');
            $table->string('supervisor_email');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_surveys');
    }
};