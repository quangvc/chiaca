<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShiftResource;
use Illuminate\Http\Request;
use App\Models\Shift_user;
use App\Models\Shift;
use Illuminate\Support\Facades\Validator;

class ShiftApiController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();
        $arr = ['status' => 200, 'message' => 'ok', 'data' => ShiftResource::collection($shifts)];
        return response()->json([$arr]);
    }

    public function show($id)
    {
        $show = Shift::find($id);
        if ($show) {
            return response()->json([
                'data' => $show,
                'message' => 'Data showed successfully.'
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->only('start_time', 'end_time'), [
            'start_time' => 'date',
            'end_time' => 'date',
        ], [
            'start_time.date' => 'Nhập sai start_time rồi, nhập lại đi',
            'end_time.date' => 'Nhập sai end_time rồi, nhập lại đi'
        ]);

        if ($validator->fails()) {
            $hasError = $validator->errors();
            $errors = [];
            foreach ($hasError->all() as $err) {
                $errors[] = $err;
            }

            return response()->json([
                'data' => $errors,
                'code' => 'error 404'
                
            ])->setStatusCode(404);
        }

        $data = $request->only('start_time', 'end_time', 'position');
        if($shift = Shift::create($data)) {
            return response()->json([
                'data' => $shift,
                'message' => 'Data stored successfully.'
            ]);
        }
        return response()->json([
            'data' => null,
            'message' => 'loooooooiiiiixx'
        ]);
    }

    public function update(Request $request, $id)
    {
        $shift = Shift::find($id);
        if ($shift->update($request->only('start_time', 'end_time', 'position'))) {
            return response()->json([
                'data' => $shift,
                'message' => 'Data Updated successfully.'
            ]);
        }
    }

    public function destroy($id)
    {
        $shift = Shift::find($id);
        if ($shift && $shift->delete() ) {
            return response()->json([
                'data' => $shift,
                'message' => 'Data Deleted successfully.'
            ]);
        }
        return response()->json([
            'message' => 'Error'
        ]);
    }

}
