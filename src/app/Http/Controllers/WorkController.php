<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
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
    public function store(Request $request)
    {
        //出勤登録
        $user = Auth::user();
        $day = date('Y-m-d',strtotime('tomorrow')); //翌日０時

        $work = [
            'user_id' => request('user_id'),
            'date' => date('Y-m-d'),
            'start_time' => Carbon::now()
        ];

        $workDay = $work['date'];
        $today = date('Y-m-d');
        $start = $work['start_time'];

        if(($workDay == $today) && (empty($start))){
            return response()->json([
                'message' => '出勤済みです'
            ]);
        }

        if($today == $day){
            Work::create($work);  //翌日０時になったら新たに出勤登録
        }

        Work::create($work);
        return response()->json([
            'message' => '出勤しました'
        ], 201);
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
        //退勤登録
        $user = Auth::user();
        $work = Work::where('id',$work->id)->first();
        $time = date('H:i:s', strtotime('23:59:59'));

        // return response()->json([
        //     '' =>
        // ]);

        $end = $work->end_time;
        $workDay = $work->date; //出勤日
        $today = date('Y-m-d'); //現在の日付

        if ($end != NULL) {
            return response()->json([
                'message' => '退勤済みです'
            ]);
        }else {
            $end = Carbon::now();
            $work->save();   //$workを更新する
            return response()->json([
                'message' => 'お疲れ様でした'
            ], 201);
        }

        if ($workDay != $today) {
            $end->save($time);  //出勤日の23時59分59秒になったら退勤処理
        }
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
