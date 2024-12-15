<?php

namespace App\Http\Controllers;

use App\Dtos\ClothingDto;
use App\Dtos\DressingDto;
use App\Dtos\FlashMessageDto;
use App\Http\Requests\Clothing\MoveClothesRequest;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use function redirect;

class ClothesMovingController extends Controller
{

    public function index(Request $request): Response
    {
        return Inertia::render('Clothing/Move/Index', [
            'dressings' => DressingDto::collect($request->user()->dressings),
        ]);
    }

    public function create(Dressing $origin, Dressing $destination): Response
    {
        return Inertia::render('Clothing/Move/Create', [
            'originDressing' => DressingDto::from($origin),
            'destinationDressing' => DressingDto::from($destination),
            'clothesByCategory' => ClothingDto::collect($origin->clothes)->groupBy('clothes_category_id'),
        ]);
    }

    public function store(Dressing $origin, Dressing $destination, MoveClothesRequest $request): RedirectResponse
    {
        Gate::authorize('update', $origin);
        Gate::authorize('update', $destination);

        $origin->clothes()->whereIn('id', $request->input('clothes_id'))->update(['dressing_id' => $destination->id]);

        $count = count($request->input('clothes_id'));

        return redirect()
            ->route('dressings.show', $destination)
            ->with('success', new FlashMessageDto("$count vêtements déplacés"));
    }
}
