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
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (! Schema::hasColumn('users', 'contact_number')) {
                    $table->string('contact_number')->nullable()->after('email');
                }
                if (! Schema::hasColumn('users', 'username')) {
                    $table->string('username')->nullable()->unique()->after('contact_number');
                }
                if (! Schema::hasColumn('users', 'status')) {
                    $table->string('status')->default('pending')->after('username');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'username')) {
                    $table->dropUnique([ 'username' ]);
                    $table->dropColumn('username');
                }
                if (Schema::hasColumn('users', 'contact_number')) {
                    $table->dropColumn('contact_number');
                }
                if (Schema::hasColumn('users', 'status')) {
                    $table->dropColumn('status');
                }
            });
        }
    }
};
