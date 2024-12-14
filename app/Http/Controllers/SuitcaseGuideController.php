<?php

namespace App\Http\Controllers;

use App\Dtos\ClothingDto;
use App\Dtos\DressingDto;
use App\Models\Dressing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class SuitcaseGuideController extends Controller
{

    public function index(Request $request): Response
    {
        return Inertia::render('Suitcase/Index', [
            'dressings' => DressingDto::collect($request->user()->dressings),
        ]);
    }

    public function show(Dressing $origin, Dressing $destination): Response
    {
        $clothesCountByCategoryInDestination = $destination->clothes()
            ->select('clothes_category_id', DB::raw('count(*) as total'))
            ->groupBy('clothes_category_id')
            ->pluck('total', 'clothes_category_id')
            ->toArray();

        $clothesMinByCategoryInDestination = $destination->clothesCategoryRequirements()
            ->pluck('min', 'clothes_category_id');

        return Inertia::render('Suitcase/Show', [
            'originDressing' => DressingDto::from($origin),
            'destinationDressing' => DressingDto::from($destination),
            'clothesCountByCategoryInDestination' => $clothesCountByCategoryInDestination,
            'clothesMinByCategoryInDestination' => $clothesMinByCategoryInDestination,
            'clothesByCategoryAtOrigin' => ClothingDto::collect($origin->clothes)->groupBy('clothes_category_id'),
        ]);
    }
}
