<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    // Get all units
    public function index()
    {
        $units = Unit::all();

        return view('admin.units.list', compact('units'));
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'unit_name' => ['required', 'string', 'unique:units'],
        ]);

        Unit::create($formFields);

        return redirect()->route('units.create')->with('success','A new unit created successfully');
    }

    public function edit(Unit $unit)
    {
        //dd($unit);
        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
       $formFields = $request->validate([
        'unit_name' => ['required', 'string'],
       ]);

       $unit->update($formFields);

       return redirect()->route('units.index')->with('success', 'Unit updated successfully');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'This unit has deleted successfully');
    }
}
