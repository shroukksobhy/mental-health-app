<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            "birthdate" => ['required', 'date']
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "birthdate" => $request->birthdate
        ]);
        // Create a Member Profile
        $memberProfile = Profile::create([
            'user_id' => $user->id,
            "role_id" => 0
        ]);
        // event(new Registered($user));
        return response()->json([
            'user' => $user,
        ], Response::HTTP_CREATED);
    }//
}