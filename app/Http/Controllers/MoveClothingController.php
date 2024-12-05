<?php

namespace App\Http\Controllers;

use App\Models\Clothing;
use App\Models\Dressing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use function redirect;

class MoveClothingController extends Controller
{
    public function __invoke(Clothing $clothing, Dressing $dressing): RedirectResponse
    {
        $oldDressing = $clothing->dressing;
        Gate::authorize('update', $oldDressing);
        Gate::authorize('update', $dressing);

        $clothing->update([
            'dressing_id' => $dressing->id,
        ]);

        return redirect()->route('dressings.show', $oldDressing);
    }
}
