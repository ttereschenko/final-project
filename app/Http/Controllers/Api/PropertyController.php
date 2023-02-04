<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Property\CreateRequest;
use App\Http\Requests\Api\Property\EditRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use App\Services\PropertyService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    public function __construct(
        private PropertyService $propertyService,
    ) {
    }

//    public function create(CreateRequest $request): PropertyResource
//    {
//        $data = $request->validated();
//        $user = $request->user();
//
//        $property = $this->propertyService->create($data, $user);
//
//        return new PropertyResource($property);
//    }

    public function list(): AnonymousResourceCollection
    {
        $properties = Property::query()->with(['user', 'type'])->latest()->paginate();

        return PropertyResource::collection($properties);
    }

    public function show(Property $property): PropertyResource
    {
        return new PropertyResource($property);
    }


//    public function edit(Property $property, EditRequest $request): PropertyResource
//    {
//        $data = $request->validated();
//
//        $this->propertyService->edit($property, $data);
//
//        return new PropertyResource($property);
//    }

    public function delete(Property $property): Response
    {
        $this->propertyService->delete($property);

        $data = [
            'message' => 'Successfully deleted!'
        ];

        return response($data, 200);
    }
}
