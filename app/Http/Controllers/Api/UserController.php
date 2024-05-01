<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Succeed get all user.',
            'data'  => [
                'users' => UserModel::all(),
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            rules: [
                'level_id' => 'required|exists:m_level,level_id',
                'username' => 'required|unique:m_user,username|max:20',
                'nama' => 'required|max:100',
                'password' => 'required|min:4|max:20',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status_code' => 400,
                'message' => 'Bad Request.',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        if (!$user) {
            return response()->json([
                'success' => false,
                'status_code' => 500,
                'message' => 'There is a problem with the server.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'status_code' => 201,
            'message' => 'Succeed create a new user.',
            'data' => [
                'user' => $user,
            ]
        ], 201);
    }

    public function show(int $user_id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Succeed get user detail.',
            'data' => [
                'user' => UserModel::find($user_id)
            ]
        ]);
    }

    public function update(Request $request, int $user_id)
    {
        $validator = Validator::make($request->all(), [
            'level_id' => 'exists:m_level,level_id',
            'username' => 'unique:m_user,username,' . $user_id . ',user_id|max:20',
            'nama' => 'max:100',
            'password' => 'min:4|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status_code' => 400,
                'message' => 'Bad Request.',
                'errors' => $validator->errors(),
            ], 400);
        }

        UserModel::find($user_id)->update($request->all());

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Succeed update user.',
            'data' => [
                'user' => UserModel::find($user_id)
            ]
        ], 200);
    }

    public function destroy(int $user_id)
    {
        $user = UserModel::find($user_id);

        if (!$user) {
            return response()->json([
                'success'=> false,
                'status_code' => 404,
                'message' => 'User not found.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Succeed delete user.',
        ], 200);
    }
}
