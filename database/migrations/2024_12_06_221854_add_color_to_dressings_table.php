<?php

use App\Enums\DressingColor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('dressings', function (Blueprint $table) {
            $table->string('color')
                ->after('name');
        });

        DB::table('dressings')->update(['color' => DressingColor::AMBER]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dressings', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
