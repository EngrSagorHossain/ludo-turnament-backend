<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TournamentRegister; // Import the TournamentRegister model
use Illuminate\Support\Facades\Auth;

class TournamentRegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'payments_method' => 'required|string',
            'transaction_id' => 'required|string',
            'amount' => 'required|string',
            'account_no' => 'required|string',
            'status' => 'required|string',
        ]);

        // Add the authenticated user's ID to the validated data
        $validatedData['user_id'] = Auth::id();

        // Create a new TournamentRegister record
        $tournamentRegister = TournamentRegister::create($validatedData);

        // Return a success response
        return response()->json(['message' => 'Tournament registration created successfully', 'tournament_register' => $tournamentRegister], 201);
    }
}
