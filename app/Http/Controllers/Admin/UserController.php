<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\UserCredentialsMail;
use App\Models\ItsidImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'whatsapp_number' => 'nullable|string|max:20',
            'role' => 'required|string|in:user,admin',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Prepare data for updating
        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'role' => $validated['role'],
        ];

        // Update is_admin based on role
        $updateData['is_admin'] = ($validated['role'] === 'admin');

        // Only update the password if a new one was provided
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function showImportForm()
    {
        return view('admin.users.import');
    }

    public function handleImport(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $file = fopen($path, 'r');
        fgetcsv($file); // Skip header

        $successCount = 0;
        $errorCount = 0;

        while (($row = fgetcsv($file)) !== false) {
            $itsid = $row[0] ?? null;

            $validator = Validator::make(['itsid' => $itsid], [
                'itsid' => 'required|numeric|digits:8',
            ]);

            if ($validator->passes()) {
                ItsidImport::firstOrCreate(['itsid' => $itsid]);
                $successCount++;
            } else {
                $errorCount++;
            }
        }
        fclose($file);

        return redirect()->route('admin.users.import')
            ->with('success', "Import complete. {$successCount} ITSIDs imported successfully, {$errorCount} failed validation.");
    }

    public function showItsids()
    {
        $itsids = ItsidImport::all();
        return view('admin.itsids.index', compact('itsids'));
    }

    public function fetchItsidDetails(ItsidImport $itsidImport)
    {
        if ($itsidImport->status === 'fetched') {
            return redirect()->route('admin.itsids.index')->with('error', 'Details for this ITSID have already been fetched.');
        }

        // --- Step 1: Simulate API Call ---
        $fakeData = [
            'name' => 'User ' . $itsidImport->itsid, // Fake name
            'email' => strtolower($itsidImport->itsid) . '@example.com',
            'whatsapp_number' => '99999' . substr($itsidImport->itsid, 0, 5),
        ];

        // --- Step 2: Generate a temporary hashed password ---
        $password = Str::random(10); // A temporary password, will be reset by user

        // --- Step 3: Create the User ---
        User::create([
            'name' => $fakeData['name'],
            'email' => $fakeData['email'],
            'itsid' => $itsidImport->itsid,
            'password' => Hash::make($password),
        ]);

        // --- Step 4: Update the ItsidImport record with fetched data ---
        $itsidImport->update([
            'name' => $fakeData['name'],
            'email' => $fakeData['email'],
            'whatsapp_number' => $fakeData['whatsapp_number'],
            'status' => 'fetched',
        ]);

        return redirect()->route('admin.itsids.index')->with('success', 'User created successfully for ITSID ' . $itsidImport->itsid);
    }

    public function sendCredentials(Request $request)
    {
        $request->validate([
            'selected_itsids' => 'required|array',
        ]);

        $selectedIds = $request->input('selected_itsids');

        // For now, just dump the selected IDs to see if it works
        dd($selectedIds);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'itsid' => 'required|string|max:255|unique:users',
            'whatsapp_number' => 'nullable|string|max:20',
            'role' => 'required|string|in:user,admin',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'itsid' => $validated['itsid'],
            'whatsapp_number' => $validated['whatsapp_number'],
            'role' => $validated['role'],
            'is_admin' => ($validated['role'] === 'admin'),
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
}