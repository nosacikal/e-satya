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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('name');
            $table->string('department_name');
            $table->date('pns_date');
            $table->enum('submission_type', ['10 Tahun', '20 Tahun', '30 Tahun']);
            $table->string('file_drh');
            $table->string('file_sk_cpns');
            $table->string('file_sk_pns');
            $table->enum('status', ['submitted', 'verification', 'processing', 'approved', 'completed'])->default('submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
