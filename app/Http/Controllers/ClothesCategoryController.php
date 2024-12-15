<?php

namespace App\Http\Controllers;

use App\Dtos\ClothesCategoryDto;
use App\Dtos\DressingDto;
use App\Dtos\FlashMessageDto;
use App\Http\Requests\StoreClothingCategoryRequest;
use App\Http\Requests\UpdateClothingCategoryRequest;
use App\Models\ClothesCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use function redirect;

class ClothesCategoryController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('ClothesCategory/Index', [
            'clothesCategories' => ClothesCategoryDto::collect($request->user()->clothesCategories()->latest()->get()),
        ]);
    }

    public function store(StoreClothingCategoryRequest $request): RedirectResponse
    {
        Gate::authorize('create', ClothesCategory::class);

        $clothesCategory = $request->user()->clothesCategories()->create($request->validated());

        return redirect()
            ->route('clothes-categories.index')
            ->with('success', new FlashMessageDto("Catégorie $clothesCategory->name créée"));
    }

    public function edit(Request $request, ClothesCategory $clothesCategory): Response
    {
        return Inertia::render('ClothesCategory/Edit', [
            'clothesCategory' => ClothesCategoryDto::from($clothesCategory),
            'clothesMinByDressing' => $clothesCategory->clothesCategoryRequirements()->pluck('min', 'dressing_id'),
            'dressings' => DressingDto::collect($request->user()->dressings),
        ]);
    }

    public function update(UpdateClothingCategoryRequest $request, ClothesCategory $clothesCategory): RedirectResponse
    {
        Gate::authorize('update', $clothesCategory);

        $validated = $request->validated();
        $clothesCategory->update([
            'name' => $validated['name'],
        ]);

        foreach ($validated['clothesMinByDressing'] as $dressingId => $min) {
            $clothesCategory->clothesCategoryRequirements()->where('dressing_id', $dressingId)->update([
                'min' => $min,
            ]);
        }

        return redirect()
            ->route('clothes-categories.index')
            ->with('success', new FlashMessageDto("Catégorie $clothesCategory->name modifiée"));
    }

    public function destroy(ClothesCategory $clothesCategory): RedirectResponse
    {
        Gate::authorize('delete', $clothesCategory);

        $clothesCategory->delete();

        return redirect()
            ->route('clothes-categories.index')
            ->with('success', new FlashMessageDto("Catégorie $clothesCategory->name supprimée"));
    }
}
