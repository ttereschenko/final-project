<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Type\CreateRequest;
use App\Http\Requests\Api\Type\EditRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Services\TypeService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    public function __construct(private TypeService $typeService)
    {
    }

    public function create(CreateRequest $request): TypeResource
    {
        $data = $request->validated();
        $type = $this->typeService->create($data);

        return new TypeResource($type);
    }

    public function list(): AnonymousResourceCollection
    {
        $types = Type::query()->paginate();

        return TypeResource::collection($types);
    }

    public function edit(Type $type, EditRequest $request): TypeResource
    {
        $data = $request->validated();
        $this->typeService->edit($type, $data);

        return new TypeResource($type);
    }

    public function delete(Type $type): Response
    {
        $this->typeService->delete($type);

        $data = [
            'message' => 'Successfully deleted!'
        ];

        return response($data, 200);
    }
}
