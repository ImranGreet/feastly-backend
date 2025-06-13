<?php
namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
            'contact' => 'nullable|string',
        ]);

        $Organization = Organization::create([
             ...$validated,
        ]);

        return response()->json($Organization, 201);
    }

    public function show(Organization $Organization)
    {
        return $Organization->load('owner');
    }

    public function update(Request $request, Organization $Organization)
    {

        $Organization->update($request->only('name', 'address', 'contact'));
        return response()->json($Organization);
    }

    public function destroy(Organization $Organization)
    {

        $Organization->delete();
        return response()->json(null, 204);
    }

}
