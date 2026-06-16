<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->string('namaTagihan');
            $table->double('totalTagihan');
            $table->integer('jumlahOrang');
            $table->boolean('pakaiPajak');
            $table->double('persentasePajak');
            $table->double('hasilPerOrang');
            $table->string('tanggalDibuat');
            $table->string('imageId')->nullable();
            $table->boolean('isDeleted')->default(false);
            $table->string('deletedAt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};