<?php

namespace App\Http\Controllers;

use App\Dtos\DressingDto;
use App\Dtos\FlashMessageDto;
use App\Http\Requests\Clothing\StoreClothingRequest;
use App\Http\Requests\Clothing\UpdateClothingRequest;
use App\Models\Clothing;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use function redirect;

class ClothingController extends Controller
{
    public function create(Dressing $dressing): Response
    {
        Gate::authorize('create', [Clothing::class, $dressing]);

        return Inertia::render('Dressings/Clothing/Create', [
            'dressing' => DressingDto::from($dressing),
        ]);
    }

    public function store(StoreClothingRequest $request, Dressing $dressing)
    {
        Gate::authorize('create', [Clothing::class, $dressing]);

        $clothing = $dressing->clothes()->create($request->validated());

        foreach ($request->all()['images'] as $image) {
            assert($image instanceof UploadedFile);

            $clothing->addMedia($image)->toMediaCollection();
        }

        return redirect()
            ->route('dressings.clothes.create', $dressing)
            ->with('success', new FlashMessageDto('Vêtement ajouté'));
    }

    public function update(UpdateClothingRequest $request, Clothing $clothing)
    {
        Gate::authorize('update', $clothing);

        $clothing->update($request->validated());

        return redirect()
            ->route('dressings.show', $clothing->dressing)
            ->with('success', new FlashMessageDto('Vêtement modifié'));
    }

    public function destroy(Clothing $clothing): RedirectResponse
    {
        Gate::authorize('delete', $clothing);

        $clothing->delete();

        return redirect()
            ->route('dressings.show', $clothing->dressing)
            ->with('success', new FlashMessageDto('Vêtement supprimé'));
    }
}
