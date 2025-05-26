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
            $table->unsignedBigInteger('profession_category_id');
            $table->unsignedBigInteger('profession_id')->nullable();

            $table->string('phone');
            $table->string('email');
            $table->date('first_work_date')->nullable();
            $table->integer('waiting_period')->nullable();

            $table->string('institution_type')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('institution_location')->nullable();
            $table->date('first_institution_work_date')->nullable();

            $table->string('supervisor_name')->nullable();
            $table->string('supervisor_position')->nullable();
            $table->string('supervisor_email')->nullable();
            $table->timestamps();

            $table->foreign('student_nim')->references('nim')->on('students');
            $table->foreign('profession_category_id')->references('id')->on('profession_categories');
            $table->foreign('profession_id')->references('id')->on('professions');
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