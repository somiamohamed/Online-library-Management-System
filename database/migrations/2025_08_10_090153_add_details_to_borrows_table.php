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
        Schema::table('borrows', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->after('id');
            $table->foreignId('book_id')->constrained()->after('user_id');
            $table->timestamp('borrowed_at')->nullable()->after('book_id');
            $table->timestamp('return_by')->nullable()->after('borrowed_at');
            $table->timestamp('returned_at')->nullable()->after('return_by');
            $table->enum('status', ['borrowed', 'returned'])->default('borrowed')->after('returned_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrows', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['book_id']);
            $table->dropColumn(['user_id', 'book_id', 'borrowed_at', 'return_by', 'returned_at', 'status']);
        });
    }
};
