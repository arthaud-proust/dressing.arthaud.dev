<?php

use App\Enums\ClothingCategory;
use App\Models\ClothesCategory;
use App\Models\Dressing;
use App\Models\User;
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
        Schema::create('clothes_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create('clothes_category_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ClothesCategory::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Dressing::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer("min");
        });

        Schema::table('clothes', function (Blueprint $table) {
            $table->foreignIdFor(ClothesCategory::class)
                ->after('dressing_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

        $clothingCategoryName = static function (ClothingCategory $case) {
            return match ($case) {
                ClothingCategory::OTHERS => "Autres",
                ClothingCategory::TROUSERS_AND_LEGGINGS => "Pantalons et leggings",
                ClothingCategory::SHORTS => "Shorts",
                ClothingCategory::TOPS_AND_T_SHIRTS => "Hauts et t-shirts",
                ClothingCategory::SWEATSHIRTS_AND_JUMPERS => "Sweats et pulls",
                ClothingCategory::SOCKS => "Chaussettes",
                ClothingCategory::UNDERWEAR => "Culottes/Caleçons",
                ClothingCategory::BRAS => "Soutiens-gorge",
                ClothingCategory::PYJAMAS => "Pyjamas",
                ClothingCategory::SUITS_AND_BLAZERS => "Costumes et blazers",
                ClothingCategory::SPORTSWEAR => "Vêtements de sport",
            };
        };

        $clothingCategoryCase = static function (string $name) {
            return match ($name) {
                "Autres" => ClothingCategory::OTHERS,
                "Pantalons et leggings" => ClothingCategory::TROUSERS_AND_LEGGINGS,
                "Shorts" => ClothingCategory::SHORTS,
                "Hauts et t-shirts" => ClothingCategory::TOPS_AND_T_SHIRTS,
                "Sweats et pulls" => ClothingCategory::SWEATSHIRTS_AND_JUMPERS,
                "Chaussettes" => ClothingCategory::SOCKS,
                "Culottes/Caleçons" => ClothingCategory::UNDERWEAR,
                "Soutiens-gorge" => ClothingCategory::BRAS,
                "Pyjamas" => ClothingCategory::PYJAMAS,
                "Costumes et blazers" => ClothingCategory::SUITS_AND_BLAZERS,
                "Vêtements de sport" => ClothingCategory::SPORTSWEAR,
            };
        };

        DB::table('users')->orderBy('id')->each(function ($value) use ($clothingCategoryName, $clothingCategoryCase) {
            $userId = $value->id;
            $dressingIds = DB::table('dressings')->where('user_id', $userId)->pluck('id');

            $clothesCategories = [];
            foreach (ClothingCategory::cases() as $case) {
                $clothesCategories[] = [
                    'name' => $clothingCategoryName($case),
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('clothes_categories')->insert($clothesCategories);

            $clothesCategoryIdsByName = DB::table('clothes_categories')
                ->where('user_id', $userId)
                ->pluck('id', 'name');

            foreach (ClothingCategory::cases() as $case) {
                DB::table('clothes')
                    ->whereIn('dressing_id', $dressingIds)
                    ->where('category', $case->value)
                    ->update([
                        'clothes_category_id' => $clothesCategoryIdsByName[$clothingCategoryName($case)],
                    ]);
            }

            $clothesCategoryRequirements = [];
            foreach ($dressingIds as $dressingId) {
                foreach ($clothesCategoryIdsByName as $clothesCategoryId) {
                    $clothesCategoryRequirements[] = [
                        'dressing_id' => $dressingId,
                        'clothes_category_id' => $clothesCategoryId,
                        'min' => 0,
                    ];
                }
            }

            DB::table('clothes_category_requirements')->insert($clothesCategoryRequirements);
        });

        Schema::table('clothes', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothes_category_requirements');
        Schema::dropIfExists('clothes_categories');

        Schema::table('clothes', function (Blueprint $table) {
            $table->dropForeignIdFor(ClothesCategory::class);
            $table->dropColumn('clothes_category_id');
            $table->integer('category');
        });

        DB::table('clothes')->update(['category' => 0]);
    }
};
