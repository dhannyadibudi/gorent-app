<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gor;
use Inertia\Inertia;
use App\Services\CourtService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Court\StoreCourtRequest;
use App\Http\Requests\Court\UpdateCourtRequest;

class CourtController extends Controller
{
    public function __construct(
        protected CourtService $courtService
    ) {}

    public function index(Request $request)
    {
        return Inertia::render(
            'Admin/Court/Index',
            [
                'courts' => $this->courtService
                    ->paginate(
                        perPage: 10,
                        search: $request->search,
                        gorId: $request->gor_id
                    ),

                'gors' => Gor::query()
                    ->select('id', 'name')
                    ->orderBy('name')
                    ->get(),

                'filters' => [
                    'search' => $request->search,
                    'gor_id' => $request->gor_id,
                ]
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Admin/Court/Create',
            [
                'gors' => Gor::query()
                    ->select('id', 'name')
                    ->orderBy('name')
                    ->get()
            ]
        );
    }

    public function store(
        StoreCourtRequest $request
    ) {

        $this->courtService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.courts.index')
            ->with(
                'success',
                'Court created successfully'
            );
    }

    public function edit(string $id)
    {
        return Inertia::render(
            'Admin/Court/Edit',
            [
                'court' => $this->courtService
                    ->findById($id),

                'gors' => Gor::query()
                    ->select('id', 'name')
                    ->orderBy('name')
                    ->get()
            ]
        );
    }

    public function update(
        UpdateCourtRequest $request,
        string $id
    ) {

        $this->courtService->update(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('admin.courts.index')
            ->with(
                'success',
                'Court updated successfully'
            );
    }

    public function destroy(string $id)
    {
        $this->courtService
            ->delete($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'Court deleted successfully'
            );
    }
}