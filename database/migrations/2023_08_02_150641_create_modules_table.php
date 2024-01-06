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
        Schema::disableForeignKeyConstraints();

        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('meet_id');
            $table->longText('content');
            $table->dateTime('created_at')->nullable()->default(null);
            $table->dateTime('updated_at')->nullable()->default(null);

            $table->foreign('meet_id')->references('id')->on('meets')->cascadeOnDelete();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('modules');

        Schema::enableForeignKeyConstraints();
    }
};
