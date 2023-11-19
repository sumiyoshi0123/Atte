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
        $day = strtotime('tomorrow');//翌日０時

        $work = [
            'user_id' => $request->id,
            'date' => date('Y-m-d'),
            'start_time' => Carbon::now()];

        $start = $work['start_time'];
        $today = $work['date'];

        if($start == NULL){
            Work::create($work);
            return response() -> json([
                'message' => '出勤しました'
            ], 201);
        }else if(empty($start)){
            return response()->json([
                'message' => '出勤済みです'
            ]);
        }else if($today == $day){
            Work::create($work);  //翌日０時になったら新たに出勤登録
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
        //退勤登録
        $user = Auth::user();
        $work = Work::where($request->id)->first();
        $today = strtotime("23:59:59");

        //
        // return response()->json([
        //     'message' => '出勤していません'
        // ]);
        //
        if ($work->end_time == NULL) {
            $work->end_time = Carbon::now();
            $work->save();   //$workを更新する
            return response()->json([
                'message' => 'お疲れ様でした'
            ], 201);
        } else if ($work->end_time != NULL) {
            return response()->json([
                'message' => '退勤済みです'
            ]);
        } else if ($work->end_time == $today) {
            $work->save();  //当日の23時59分59秒になったら退勤処理
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
