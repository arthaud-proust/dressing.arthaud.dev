<?php

namespace App\Http\Controllers;

use App\Dtos\ClothesCategoryDto;
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

        $request->user()->clothesCategories()->create($request->validated());

        return redirect()->route('clothes-categories.index');
    }

    public function update(UpdateClothingCategoryRequest $request, ClothesCategory $clothesCategory): RedirectResponse
    {
        Gate::authorize('update', $clothesCategory);

        $clothesCategory->update($request->validated());

        return redirect()->route('clothes-categories.index');
    }

    public function destroy(ClothesCategory $clothesCategory): RedirectResponse
    {
        Gate::authorize('delete', $clothesCategory);

        $clothesCategory->delete();

        return redirect()->route('clothes-categories.index');
    }
}
