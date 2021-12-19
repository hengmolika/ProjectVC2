<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'max:10|required',
            'email' => ['email', 'unique:users'],
            'password' => ['min:4|max:8', 'confirmed'],
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:1999|',

        ]);
        //create user
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->profile = $request->profile;
        if($request->profile !== null) {
            $request->file('profile')->store('public/images');
            $user->profile = $request->file('profile')->hashName();
        } else {
            $user->profile = "";
        };
        $user->password = bcrypt($request->password);

        $user->save();

        //create token is a key can access to api
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'User logout']);
    }
    
    public function login(Request $request)
    {
        //check email
        $user = User::where('email', $request->email)->first();

        //check password
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Bad login'], 401);
        }
        //create token is a key can access to api
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    public function index()
    {
        return User::latest()->get();
    }
    public function show($id)
    {
        return User::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'max:10|required',
            'email' => ['email', 'unique:users'],
            'password' => ['min:4|max:8', 'confirmed'],
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:1999|',

        ]);
        //create user
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->profile = $request->profile;
        if($request->profile !== null) {
            $request->file('profile')->store('public/images');
            $user->profile = $request->file('profile')->hashName();
        } else {
            $user->profile = "";
        };
        $user->save();

        return response()->json(['message' => 'user updated!'], 200);
    }
    public function destroy($id)
    {
        return User::destroy($id);
    }
}
