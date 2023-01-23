<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;

class OwnerController extends Controller
{
    public function changeRole()
    {
        $user = auth()->user();

        User::query()
            ->where('id', '=', $user->id)
            ->update(['role' => User::ROLE_OWNER]);

        session()->flash('success', 'Create your first announcement!');

        return redirect()->route('property.create');
    }

    public function createdAnnouncementList()
    {
        $user = auth()->user();

        $properties = Property::query()
            ->where('user_id', '=', $user->id)
            ->latest()->paginate();

        return view('owner.created_properties_list', compact('properties'));
    }
}
