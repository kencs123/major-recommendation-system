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
        Schema::create('student_majors', function (Blueprint $table) {
            $table->id();
            $table->string('student_name')->index();
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade');
            $table->string('submission_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_majors');
    }
};
