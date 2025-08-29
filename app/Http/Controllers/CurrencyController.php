<?php

namespace App\Http\Controllers;

use App\Models\Currency; // Add this line
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.currencies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:currencies',
            'symbol' => 'required|string|max:5',
        ]);

        Currency::create($validated);

        return redirect()->route('currencies.index')->with('success', 'Currency created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:currencies,code,' . $currency->id,
            'symbol' => 'required|string|max:5',
        ]);

        $currency->update($validated);

        return redirect()->route('currencies.index')->with('success', 'Currency updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        return redirect()->route('currencies.index')->with('success', 'Currency deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'selected_currencies' => 'required|array',
        ]);

        Currency::destroy($request->input('selected_currencies'));

        return redirect()->route('currencies.index')->with('success', 'Selected currencies deleted successfully.');
    }

}