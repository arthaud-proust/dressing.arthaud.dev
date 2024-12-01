<?php

namespace App\Http\Controllers;

use App\Dtos\DressingDto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Dashboard', [
            'dressings' => DressingDto::collect($request->user()->dressings()->get()),
        ]);
    }
}
