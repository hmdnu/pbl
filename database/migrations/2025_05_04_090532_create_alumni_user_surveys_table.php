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
        Schema::create('alumni_user_surveys', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // nama
            $table->string('institution_type'); // jenis_instansi
            $table->string('institution_name'); // nama_instansi
            $table->string('institution_location'); // lokasi_instansi
            $table->string('institution_scale'); // skala_instansi
            $table->string('position'); // jabatan
            $table->string('email'); // email
            $table->string('student_nim'); // mahasiswa_nim
            $table->foreign('student_nim')->references('nim')->on('students');

            $table->foreignId('alumni_evaluation_id')->constrained('alumni_evaluations'); // penilaian_alumni_id
            $table->text('curriculum_suggestion'); // saran_kurikulum

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_user_surveys');
    }
};
