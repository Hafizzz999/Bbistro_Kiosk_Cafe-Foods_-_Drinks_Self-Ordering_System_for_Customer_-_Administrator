<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiningTable;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = DiningTable::paginate(10);
        return view('admin.table.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.table.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['table_number' => 'required']);
        DiningTable::create($request->all());
        return redirect()->route('table.index')->with('success', 'Table added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiningTable $table)
    {
        return view('admin.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiningTable $table)
    {
        $request->validate(['table_number' => 'required']);
        $table->update($request->all());
        return redirect()->route('table.index')->with('success', 'Table updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiningTable $table)
    {
        $table->delete();
        return redirect()->route('table.index')->with('success', 'Table deleted!');
    }
}
