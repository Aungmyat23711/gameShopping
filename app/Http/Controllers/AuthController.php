<?php

namespace App\Http\Controllers;

use App\interfaces\authInterface;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    protected authInterface $authInterface;
    public function __construct(authInterface $authInterface)
    {
        $this->authInterface = $authInterface;
    }
    public function register(Request $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['msg' => 'Registered Successfully']);
    }
    public function login(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['msg' => 'The provided creditials are incorrect']);
        }
        return $admin->createToken($request->email)->plainTextToken;
    }
    public function registerUser(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['msg' => 'Registered Successfully']);
    }
    public function loginUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['msg' => 'The provided creditials are incorrect']);
        }
        return $user->createToken($request->email)->plainTextToken;
    }
    public function getAllUsers()
    {
        $user = User::all();
        return $user;
    }
}
