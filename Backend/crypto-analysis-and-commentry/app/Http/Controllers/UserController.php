<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function getAllUser()
    {

        $userAll = User::get();
        return response()->json([
            "message" => "Users retrieved successfully",
            "users" => $userAll
        ]);
    }
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {

            return response()->json(["message" => "User not found"]);
        }
        return response()->json(['users' => $user], 200);
    }

    public function create(UserRequest $request)
    {
        try {

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),

            ]);
            return response()->json(["message" => "Succesfly create user"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went really wrong"], 500);
        }
    }
    public function loginUser(Request $request)
    {
        //dd($request);
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(["message" => "User not found"], 404);
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return response()->json(["message" => "Succesfly update user"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something bok really wrong"], 500);
        }
    }
    public function delete($id)
    {

        $user = User::find($id);
        if (!$user) {
            return response()->json(["message" => "User not found"], 404);
        }

        $user->delete();
        return response()->json(["message" => "User Succesfly deleted"]);
    }
}
