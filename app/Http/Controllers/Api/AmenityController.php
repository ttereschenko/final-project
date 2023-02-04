<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Amenity\CreateRequest;
use App\Http\Requests\Api\Amenity\EditRequest;
use App\Http\Resources\AmenityResource;
use App\Models\Amenity;
use App\Services\AmenityService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AmenityController extends Controller
{
    public function __construct(private AmenityService $amenityService)
    {
    }

    public function create(CreateRequest $request): AmenityResource
    {
        $data = $request->validated();
        $amenity = $this->amenityService->create($data);

        return new AmenityResource($amenity);
    }

    public function list(): AnonymousResourceCollection
    {
        $amenities = Amenity::query()->paginate();

        return AmenityResource::collection($amenities);
    }

    public function edit(Amenity $amenity, EditRequest $request): AmenityResource
    {
        $data = $request->validated();
        $this->amenityService->edit($amenity, $data);

        return new AmenityResource($amenity);
    }

    public function delete(Amenity $amenity): Response
    {
        $this->amenityService->delete($amenity);

        $data = [
            'message' => 'Successfully deleted!'
        ];

        return response($data, 200);
    }
}
