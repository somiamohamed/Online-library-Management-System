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
        Schema::table('books', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('author')->after('title');
            $table->text('description')->nullable()->after('author');
            $table->string('cover_image')->nullable()->after('description');
            $table->integer('quantity')->default(1)->after('cover_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['title', 'author', 'description', 'cover_image', 'quantity']);
        });
        });
    }
};
