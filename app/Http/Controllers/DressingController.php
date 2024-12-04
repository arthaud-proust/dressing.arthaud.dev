<?php

namespace App\Http\Controllers;

use App\Dtos\ClothingDto;
use App\Dtos\DressingDto;
use App\Http\Requests\StoreDressingRequest;
use App\Http\Requests\UpdateDressingRequest;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use function redirect;

class DressingController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Dressings/Create');
    }

    public function store(StoreDressingRequest $request): RedirectResponse
    {
        $dressing = $request->user()->dressings()->create($request->validated());

        return redirect()->route('dressings.show', $dressing);
    }

    public function show(Dressing $dressing): Response
    {
        Gate::authorize('view', $dressing);

        return Inertia::render('Dressings/Show', [
            'dressing' => DressingDto::from($dressing),
            'clothingListByCategory' => ClothingDto::collect($dressing->clothing)->groupBy('category'),
        ]);
    }

    public function edit(Dressing $dressing): Response
    {
        Gate::authorize('update', $dressing);

        return Inertia::render('Dressings/Update', [
            'dressing' => DressingDto::from($dressing),
        ]);
    }

    public function update(UpdateDressingRequest $request, Dressing $dressing): RedirectResponse
    {
        Gate::authorize('update', $dressing);

        $dressing->update($request->validated());

        return redirect()->route('dressings.show', $dressing);
    }

    public function destroy(Dressing $dressing): RedirectResponse
    {
        Gate::authorize('delete', $dressing);

        $dressing->delete();

        return redirect()->route('dashboard');
    }
}
