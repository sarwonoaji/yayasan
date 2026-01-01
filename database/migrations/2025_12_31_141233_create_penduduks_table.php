<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();

            // Identitas
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16);

            // Status dalam keluarga
            $table->string('status_kk'); // kepala, istri, anak, dll

            // Data pribadi
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin', 10); // L / P / Laki-laki / Perempuan
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir')->nullable();
            $table->string('golongan_darah', 5)->nullable(); // A, B, AB, O

            // Status & pekerjaan
            $table->string('status_perkawinan')->nullable();
            $table->string('pekerjaan')->nullable();

            // Alamat
            $table->string('desa')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            
            // Administrasi
            $table->date('tanggal_masuk')->nullable();

            // Kontak & dokumen
            $table->string('no_telp', 20)->nullable();
            $table->string('foto')->nullable(); 
            $table->text('maps')->nullable();
            $table->boolean('is_deleted')->default(false);

            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
