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
        $work = Work::where($request->id)->first();

        $bleak = [
            'work_id' => $work,
            'start_time' => Carbon::now(),
        ];

        Bleak::create($bleak);
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
        $bleak = Bleak::where($request->id)->first();

        if ($bleak->end_time == NULL) {
            $bleak->end_time = Carbon::now();
            $bleak->save();   //更新する
            return response()->json([
                'message' => ''
            ], 201);
        } else if ($bleak->end_time != NULL) {
            return response()->json([
                'message' => ''
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
}
