<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            if (Schema::hasColumn('kamars', 'tipe_kamar')) {
                $table->dropColumn('tipe_kamar');
            }

            $table->string('gedung')->after('nomor_kamar'); 
            $table->string('jenis_kamar_mandi')->after('gedung'); 
        });
    }

    public function down(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->dropColumn(['gedung', 'jenis_kamar_mandi']);
            $table->string('tipe_kamar')->after('nomor_kamar'); 
        });
    }
};