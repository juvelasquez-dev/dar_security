<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'first_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('first_name')->nullable()->after('id');
                $table->string('middle_name')->nullable()->after('first_name');
                $table->string('last_name')->nullable()->after('middle_name');
            });
        }

        // Migrate existing `name` values into the new columns
        if (Schema::hasColumn('users', 'name')) {
            DB::table('users')->select('id', 'name')->whereNotNull('name')->orderBy('id')
                ->chunk(100, function ($users) {
                    foreach ($users as $u) {
                        $first = null;
                        $middle = null;
                        $last = null;

                        $parts = preg_split('/\s+/', trim($u->name));
                        $count = count($parts);

                        if ($count === 1) {
                            $first = $parts[0];
                        } elseif ($count === 2) {
                            $first = $parts[0];
                            $last = $parts[1];
                        } elseif ($count >= 3) {
                            $first = array_shift($parts);
                            $last = array_pop($parts);
                            $middle = implode(' ', $parts);
                        }

                        DB::table('users')->where('id', $u->id)->update([
                            'first_name' => $first,
                            'middle_name' => $middle,
                            'last_name' => $last,
                        ]);
                    }
                });

            // drop the old `name` column
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'name')) {
                    $table->dropColumn('name');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Recreate `name` column if missing
        if (!Schema::hasColumn('users', 'name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('name')->nullable()->after('id');
            });
        }

        // Combine the name parts back into `name`
        if (Schema::hasColumn('users', 'first_name') || Schema::hasColumn('users', 'last_name')) {
            DB::table('users')->select('id', 'first_name', 'middle_name', 'last_name')->orderBy('id')
                ->chunk(100, function ($users) {
                    foreach ($users as $u) {
                        $parts = array_filter([
                            $u->first_name ?? null,
                            $u->middle_name ?? null,
                            $u->last_name ?? null,
                        ]);

                        $name = implode(' ', $parts);

                        DB::table('users')->where('id', $u->id)->update([
                            'name' => $name,
                        ]);
                    }
                });
        }

        // drop the split columns
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'first_name')) {
                $table->dropColumn(['first_name', 'middle_name', 'last_name']);
            }
        });
    }
};
