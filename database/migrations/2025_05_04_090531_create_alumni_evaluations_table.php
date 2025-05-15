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
        Schema::create('alumni_evaluations', function (Blueprint $table) {
            $table->id();

            $table->string('student_nim'); // mahasiswa_nim
            $table->foreign('student_nim')->references('nim')->on('students');

            $table->string('teamwork'); // kerjasama_tim
            $table->string('it_expertise'); // keahlian_di_bidang_ti
            $table->string('foreign_language'); // kemampuan_berbahasa_asing
            $table->string('communication'); // kemampuan_berkomunikasi
            $table->string('self_development'); // pengembangan_diri
            $table->string('leadership'); // kepemimpinan
            $table->string('work_ethic'); // etos_kerja
            $table->string('unmet_competencies'); // kompetensi_yg_belum_terpenuhi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_evaluations');
    }
};