<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{   
    public function index()
    {
        $submissions = auth()->user()->submissions()->latest()->get();
        return view('submission.index', compact('submissions'));
    }
    
    public function create()
    {
        $currencies = Currency::all();
        return view('submission.create', compact('currencies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receipt_no' => 'required|string|unique:submissions',
            'receipt_date' => 'required|date',
            'name' => 'required|string|max:255',
            'its_number' => 'required|numeric|digits:8',
            'currency_id' => 'required|exists:currencies,id',
            'kh' => 'required|numeric|min:0',
            'nm' => 'required|numeric|min:0',
            'khms' => 'required|numeric|min:0',
            'si' => 'required|numeric|min:0',
            'mnt' => 'required|numeric|min:0',
            'nyz' => 'required|numeric|min:0',
            'nj' => 'required|numeric|min:0',
            'total_collection' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:cash,cheque',
            'cheques' => 'nullable|array',
            'cheques.*.payee_name' => 'required_if:payment_mode,cheque|string',
            'cheques.*.payer_name' => 'required_if:payment_mode,cheque|string',
            'cheques.*.date' => 'required_if:payment_mode,cheque|date',
            'cheques.*.amount' => 'required_if:payment_mode,cheque|numeric|min:0',
            'cheques.*.currency_id' => 'required_if:payment_mode,cheque|exists:currencies,id',
            'cheques.*.cheque_number' => 'required_if:payment_mode,cheque|string',
        ]);

        // Create the main submission record
        $submission = auth()->user()->submissions()->create($validated);

        // If payment mode is cheque, create cheque records
        if ($validated['payment_mode'] === 'cheque' && isset($validated['cheques'])) {
            foreach ($validated['cheques'] as $chequeData) {
                $submission->cheques()->create($chequeData);
            }
        }

        // We will create the submission history page next
        return redirect()->route('dashboard')->with('success', 'Submission saved successfully!');
    }

    public function edit(Submission $submission)
    {
        // Add a check to ensure users can only edit their own submissions
        if ($submission->user_id !== auth()->id()) {
            abort(403);
        }

        $currencies = Currency::all();
        return view('submission.edit', compact('submission', 'currencies'));
    }

    public function update(Request $request, Submission $submission)
    {
        if ($submission->user_id !== auth()->id()) {
            abort(403);
        }

        // Validation logic similar to the store method
        $validated = $request->validate([
            'receipt_no' => 'required|string|unique:submissions,receipt_no,' . $submission->id,
            // ... add all other validation rules from your 'store' method
        ]);

        $submission->update($validated);
        // We'll skip updating cheques for now to keep it simple

        return redirect()->route('submission.index')->with('success', 'Submission updated successfully.');
    }

    public function destroy(Submission $submission)
    {
        if ($submission->user_id !== auth()->id()) {
            abort(403);
        }

        $submission->delete();
        return redirect()->route('submission.index')->with('success', 'Submission deleted successfully.');
    }
}