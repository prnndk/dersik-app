<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas')->length(20);
            $table->foreignId('id_angkatan')->constrained('angkatans','id')->onDelete('cascade')->index();
            $table->string('nama')->length(50);
            $table->string('instagram')->length(50)->unique();
            $table->integer('jumlah')->length(2);
            $table->string('fotbar')->nullable();
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
        Schema::dropIfExists('kelas');
    }
};
