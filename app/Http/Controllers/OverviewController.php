<?php

namespace App\Http\Controllers;

use App\Dtos\Overview\ClothesCategoryOverviewDto;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OverviewController extends Controller
{
    public function __invoke(Request $request): Response
    {
        return Inertia::render('Overview', [
            'categories' => ClothesCategoryOverviewDto::collect($request->user()->clothesCategories),
        ]);
    }
}
