<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserApiController extends Controller
{
    public function index()
    {
        $users = User::all();
        $arr = ['status' => 200, 'message' => 'ok', 'data' => UserResource::collection($users)];
        return response()->json([$arr]);
    }

    public function show($id)
    {
        $show = User::find($id);
        if ($show) {
            return response()->json([
                'data' => $show,
                'message' => 'Data showed successfully.'
            ]);
        }
    }

    public function store(Request $request)
    {
        
        $data = ['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password), 'role' => $request->role];
        if($user = User::create($data)) {
            return response()->json([
                'data' => $user,
                'message' => 'Data stored successfully.'
            ]);
        }
        return response()->json([
            'data' => null,
            'message' => 'Loiooooooooooooxx'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->update($request->only('name', 'email', 'role'))) {
            return response()->json([
                'data' => $user,
                'message' => 'Data Updated successfully.'
            ]);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user && $user->delete() ) {
            return response()->json([
                'data' => $user,
                'message' => 'Data Deleted successfully.'
            ]);
        }
        return response()->json([
            'message' => 'Error'
        ]);
    }
}
