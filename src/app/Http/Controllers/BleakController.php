<?php

namespace App\Http\Controllers;

use App\Models\bleak;
use App\Models\Work;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BleakController extends Controller
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
        $user = Auth::user();
        $today = Carbon::today();
        $work = Work::where('user_id',$user->id)->where('date',$today)->first();
        //その日のworkを取り出す

        $bleak = [
            'work_id' => $work->id,
            'start_time' => Carbon::now(),
        ];

        Bleak::create($bleak);

        return response()->json([
            'work' => $work,
            'bleak' => $bleak
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bleak  $bleak
     * @return \Illuminate\Http\Response
     */
    public function show(bleak $bleak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bleak  $bleak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, bleak $bleak)
    {
        $user = Auth::user();
        $bleak = Bleak::where('id',$bleak->id)->first();

        if ($bleak->end_time == NULL) {
            $bleak->end_time = Carbon::now();
            $bleak->save();   //更新する
            return response()->json([
                'message' => 'break ends'//休憩終了
            ], 201);
        } else if ($bleak->end_time != NULL) {
            return response()->json([
                'message' => 'took a break'//休憩済み
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bleak  $bleak
     * @return \Illuminate\Http\Response
     */
    public function destroy(bleak $bleak)
    {
        //
    }

    public function bleakEnd(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $work = Work::where('user_id', $user->id)->where('date', $today)->first();

        $bleak = Bleak::where('work_id', $work->id)->where('end_time', null)->first();

        return $this->update($request, $bleak);

    }
}
