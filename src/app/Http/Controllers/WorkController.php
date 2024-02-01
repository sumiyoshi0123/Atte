<?php

namespace App\Http\Controllers;

use App\Models\Work;
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
    public function store(Request $request)
    {
        //出勤登録
        $user = Auth::user();

        $work = [
            'user_id' => $user->id,
            'date' => date('Y-m-d'),
            'start_time' => Carbon::now()
        ];

        $workDay = $work['date'];
        $today = date('Y-m-d');
        $start = $work['start_time'];

        if(($workDay == $today) && (empty($start))){
            return response()->json([
                'message' => 'Be at work'//出勤済
            ]);
        }

        Work::create($work);
        return response()->json([
            'message' => 'Start of work' //勤務開始
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

        if ($work->end_time == NULL) {
            $work->end_time = Carbon::now();
            $work->save();   //$workを更新する
            return response()->json([
                'message' => 'Leaving work' //退勤する
            ], 201);
        } else if ($work->end_time != NULL) {
            return response()->json([
                'message' => 'Already left work' //退勤済
            ]);
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

    public function workEnd(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $work = Work::where('user_id', $user->id)->where('date', $today)->where('end_time', null)->first();

        return $this->update($request, $work);
    }
}
