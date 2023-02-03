<?php

namespace App\Http\Controllers;

use App\Http\Requests\Facility\CreateRequest;
use App\Http\Requests\Facility\EditRequest;
use App\Models\Facility;
use App\Services\FacilityService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FacilityController extends Controller
{
    public function __construct(private FacilityService $facilityService)
    {
    }

    public function createForm(): View
    {
        return view('facility.create');
    }

    public function create(CreateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->facilityService->create($data);

        session()->flash('success', 'Item was successfully added');

        return redirect()->route('facility.list');
    }

    public function list(): View
    {
        $facilities = Facility::query()->paginate();

        return view('facility.list', compact('facilities'));
    }

    public function editForm(Facility $facility): View
    {
        return view('facility.edit', compact('facility'));
    }

    public function edit(Facility $facility, EditRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->facilityService->edit($facility, $data);

        session()->flash('success', 'Item was successfully edited');

        return redirect()->route('facility.list');
    }

    public function delete(Facility $facility): RedirectResponse
    {
        $this->facilityService->delete($facility);

        session()->flash('success', 'Item was successfully deleted');

        return redirect()->route('facility.list');
    }
}
