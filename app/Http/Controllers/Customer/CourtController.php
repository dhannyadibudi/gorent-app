<?php

namespace App\Http\Controllers\Customer;

use App\Models\Court;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class CourtController extends Controller
{
    public function index(Request $request)
    {
        $courts = Court::query()
            ->with([
                'gor',
            ])
            ->whereHas(
                'gor',
                fn ($q) =>
                $q->where(
                    'is_active',
                    true
                )
            )
            ->when(
                $request->search,
                function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where(
                            'name',
                            'ilike',
                            "%{$request->search}%"
                        )
                        ->orWhereHas(
                            'gor',
                            fn ($gor) =>
                            $gor->where(
                                'name',
                                'ilike',
                                "%{$request->search}%"
                            )
                        );
                    });
                }
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return Inertia::render(
            'Customer/Court/Index',
            [
                'courts' => $courts,

                'filters' => [
                    'search' =>
                        $request->search,
                ],
            ]
        );
    }
}