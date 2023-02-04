<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Facility\CreateRequest;
use App\Http\Requests\Api\Facility\EditRequest;
use App\Http\Resources\FacilityResource;
use App\Http\Resources\FavouriteResource;
use App\Models\Facility;
use App\Services\FacilityService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FacilityController extends Controller
{
    public function __construct(private FacilityService $facilityService)
    {
    }

    public function create(CreateRequest $request): FavouriteResource
    {
        $data = $request->validated();
        $facility = $this->facilityService->create($data);

        return new FavouriteResource($facility);
    }

    public function list(): AnonymousResourceCollection
    {
        $facilities = Facility::query()->paginate();

        return FacilityResource::collection($facilities);
    }

    public function edit(Facility $facility, EditRequest $request): FacilityResource
    {
        $data = $request->validated();
        $this->facilityService->edit($facility, $data);

        return new FacilityResource($facility);
    }

    public function delete(Facility $facility): Response
    {
        $this->facilityService->delete($facility);

        $data = [
            'message' => 'Successfully deleted!'
        ];

        return response($data, 200);
    }
}
