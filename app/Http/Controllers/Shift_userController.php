<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shift_user;

class Shift_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ->where('user_id', Auth::user()->id,)
        $ca_da_dang_ky = Shift_user::where('user_id', Auth::user()->id)->get();
        return view('shift_user.list', compact('ca_da_dang_ky'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shifts = Shift::all();
        return view('shift_user.create', compact('shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $shift = Shift::find($request->shift_id);
        $ca_da_dang_ky = Shift::where('id', $request->shift_id)->get();
        foreach ($ca_da_dang_ky as $cddk) {
            // dd($shift->start_time);
            if (($shift->start_time >= $cddk->start_time && $shift->start_time <= $cddk->end_time) 
            || ($shift->end_time>= $cddk->start_time && $shift->end_time <= $cddk->end_time)) {
                    return redirect()->route('shift_user.list')->with('error', 'Không thể đăng ký ca do bị trùng thời gian');
            }
        }

        $shift_user = new Shift_user();
        $shift_user->user_id = Auth::user()->id;
        $shift_user->shift_id = $request->shift_id;

        

        $shift_user->save();
        return redirect()->route('shift_user.list')->with('success', 'Đăng ký ca thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shifts = Shift::all();
        $shift_user = Shift_user::find($id);
        return view('shift_user.edit', compact('shift_user', 'shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shift_user = Shift_user::find($id);
        // $shift_user->user_id = 1;
        $shift_user->shift_id = $request->shift_id;
        $shift_user->save();
        return redirect()->route('shift_user.list')->with('success', 'Cập nhật ca thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Shift_user::destroy($id);
        return redirect()->route('shift_user.list')->with('success', 'Hủy đăng ký ca thành công');
    }
}
