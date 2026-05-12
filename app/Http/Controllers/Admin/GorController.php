<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Services\GorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Gor\StoreGorRequest;
use App\Http\Requests\Gor\UpdateGorRequest;

class GorController extends Controller
{
    public function __construct(
        protected GorService $gorService
    ) {}

    public function index(Request $request)
    {
        $gors = $this->gorService->paginate(
            perPage: 10,
            search: $request->search,
            isActive: $request->has('is_active')
                ? (bool) $request->is_active
                : null
        );

        return Inertia::render(
            'Admin/Gor/Index',
            [
                'gors' => $gors,
                'filters' => [
                    'search' => $request->search,
                    'is_active' => $request->is_active,
                ]
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Admin/Gor/Create'
        );
    }

    public function store(
        StoreGorRequest $request
    ) {

        $this->gorService->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.gors.index')
            ->with(
                'success',
                'GOR created successfully'
            );
    }

    public function edit(string $id)
    {
        return Inertia::render(
            'Admin/Gor/Edit',
            [
                'gor' => $this->gorService
                    ->findById($id)
            ]
        );
    }

    public function update(
        UpdateGorRequest $request,
        string $id
    ) {

        $this->gorService->update(
            $id,
            $request->validated()
        );

        return redirect()
            ->route('admin.gors.index')
            ->with(
                'success',
                'GOR updated successfully'
            );
    }

    public function destroy(string $id)
    {
        $this->gorService->delete($id);

        return redirect()
            ->back()
            ->with(
                'success',
                'GOR deleted successfully'
            );
    }
}