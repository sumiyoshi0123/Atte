<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;
use App\Models\Bleak;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::select('name')->get();
        $work = Work::all();
        $bleak = Bleak::all();

        $items = Work::with('user')->with('bleak')->get();

        return response()->json([
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, work $work, bleak $bleak)
    {
        //勤務開始
        $user = Auth::user();
        $work = [
            'user_id' => $user->id,
            'date' => date('Y-m-d'),
            'start_time' => Carbon::now()
        ];
        Work::create($work);
        return response()->json([
            'message' => 'Start of work'
        ], 201);

        //休憩開始
        $today = Carbon::today();
        $work = Work::where('user_id', $user->id)->where('date', $today)->first();
        $bleak = [
            'work_id' => $work->id,
            'start_time' => Carbon::now(),
        ];
        return response()->json([
            'work' => $work,
            'bleak' => $bleak
        ]);
        Bleak::create($bleak);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, work $work,bleak $bleak)
    {
        //休憩終了
        $user = Auth::user();
        $bleak = Bleak::where('id', $bleak->id)->first();

        if ($bleak->end_time == NULL) {
            $bleak->end_time = Carbon::now();
            $bleak->save();   //更新する
            return response()->json([
                'message' => 'break ends' //休憩終了
            ], 201);
        } else if ($bleak->end_time != NULL) {
            return response()->json([
                'message' => 'took a break' //休憩済み
            ]);
        }

        //退勤登録
        $user = Auth::user();
        $work = Work::where('id', $work->id)->first();

        $end = $work->end_time;

        if ($end != NULL) {
            return response()->json([
                'message' => 'Already left work' //退勤済
            ]);
        } else {
            $end = Carbon::now();
            $work->save();   //$workを更新する
            return response()->json([
                'message' => 'Leaving work' //退勤
            ], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
