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
        Schema::create('app_version', function (Blueprint $table) {
            $table->id();
            $table->string("tags", 192);
            $table->smallInteger("major_changes");
            $table->smallInteger("minor_changes");
            $table->smallInteger("fix_bug");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_version');
    }
};
