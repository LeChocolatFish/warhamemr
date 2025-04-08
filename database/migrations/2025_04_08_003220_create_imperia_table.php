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
        Schema::create('imperia', function (Blueprint $table) {
            $table->id();
            $table->string('Astra_Militarum');
            $table->string('Adeptus_Mechanicus');
            $table->string('Adeptus_Astartes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imperia');
    }
};
