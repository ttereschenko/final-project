<?php

namespace App\Http\Controllers;

use App\Http\Requests\Type\CreateRequest;
use App\Http\Requests\Type\EditRequest;
use App\Models\Type;
use App\Services\TypeService;

class TypeController extends Controller
{
    public function __construct(private TypeService $typeService)
    {
    }

    public function createForm()
    {
        return view('type.create');
    }

    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        $this->typeService->create($data);

        session()->flash('success', 'Item was successfully added');

        return redirect()->route('type.list');
    }

    public function list()
    {
        $types = Type::query()->paginate();

        return view('type.list', compact('types'));
    }

    public function editForm(Type $type)
    {
        return view('type.edit', compact('type'));
    }

    public function edit(Type $type, EditRequest $request)
    {
        $data = $request->validated();
        $this->typeService->edit($type, $data);

        session()->flash('success', 'Item was successfully edited');

        return redirect()->route('type.list');
    }

    public function delete(Type $type)
    {
        $this->typeService->delete($type);

        session()->flash('success', 'Item was successfully deleted');

        return redirect()->route('type.list');
    }
}
