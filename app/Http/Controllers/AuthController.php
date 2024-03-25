<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
//login api
public function login(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);
    // dd($validatedData);


    // Attempt to log in the user
    if (Auth::attempt(['username' => $validatedData['username'], 'password' => $validatedData['password']])) {
        $user = Auth::user();
        $token = $user->createToken('MyApp')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 200);
    } else {
        return response()->json(['message' => 'Invalid phone or password'], 401);
    }
}
//register api
public function register(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'username' => 'required|string',
        'phone' => 'required|string|unique:users',
        'address' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Create a new user
    $user = User::create([
        'name' => $validatedData['name'],
        'username' => $validatedData['username'],
        'phone' => $validatedData['phone'],
        'address' => $validatedData['address'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'rating'=>'0',
        'level'=>'0',
        'total_wins'=>'0',
        'total_coins'=>'0',
        'image' => $request->hasFile('image') ? $request->file('image')->store('image') : null,
    ]);

    // Refresh the user model to get the latest data from the database
    $user->refresh();

    $token = $user->createToken('MyApp')->plainTextToken;

    // Return the full user data in the response
    return response()->json(['user' => $user, 'token' => $token], 201);
}
  //logout
  public function logout(Request $request)
{
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'Logged out successfully'], 200);
}
      
   


}
