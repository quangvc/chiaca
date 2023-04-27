<?php

namespace App\Http\Controllers;

use App\Http\Resources\Shift_userResource;
use Illuminate\Http\Request;
use App\Models\Shift_user;
use Illuminate\Support\Facades\Auth;

class Shift_userApiController extends Controller
{
    public function index()
    {
        $ca_da_dang_ky = Shift_user::all();
        $arr = ['status' => 200, 'message' => 'ok', 'data' => Shift_userResource::collection($ca_da_dang_ky)];
        return response()->json([$arr]);
    }

    public function show($id)
    {
        $show = Shift_user::find($id);
        if ($show) {
            return response()->json([
                'data' => $show,
                'message' => 'Data showed successfully.'
            ]);
        }
    }

    public function store(Request $request)
    {
        
        $data = $request->only('shift_id', 'user_id');
        if($shift_user = Shift_user::create($data)) {
            return response()->json([
                'data' => $shift_user,
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
        $shift_user = Shift_user::find($id);
        if ($shift_user->update($request->only('shift_id', 'user_id'))) {
            return response()->json([
                'data' => $shift_user,
                'message' => 'Data Updated successfully.'
            ]);
        }
    }

    public function destroy($id)
    {
        $shift_user = Shift_user::find($id);
        if ($shift_user && $shift_user->delete() ) {
            return response()->json([
                'data' => $shift_user,
                'message' => 'Data Deleted successfully.'
            ]);
        }
        return response()->json([
            'message' => 'Error'
        ]);
    }
}
