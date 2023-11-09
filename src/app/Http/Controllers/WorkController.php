<?php

namespace App\Http\Controllers;

use App\Models\work;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function start()
    {
        //出勤登録
        $user = Auth::user();

        $work = [
            'user_id' => $user->id,
            'date' => date('Y-m-d'),
            'start_time' => Carbon::now()];

        if($work == NULL){
            Work::create($work);
            return response() -> json([
                'message' => '出勤しました'
            ], 201);
        }else{
            return response()->json([
                'message' => '出勤済みです'
            ]);
        }
    }

    public function end()
    {
        //退勤登録
        $user = Auth::user();
        $work = Work::where('work_id');
        $end = ['end_time' => Carbon::now()];

        if($work['work_id'] == NULL){
            return response()->json([
                'message' => '出勤していません'
            ]);
        }elseif($end['end_time'] == NULL){
            Work::create($end);
            return response()->json([
                'message' => 'お疲れ様でした'
            ], 201);
        }elseif($end['end_time'] !== NULL){
            return response()->json([
                'message' => '退勤済みです'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(work $work)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, work $work)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(work $work)
    {
        //
    }
}
