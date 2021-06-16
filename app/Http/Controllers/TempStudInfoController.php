<?php

namespace App\Http\Controllers;

use App\Models\TempStudInfo;
use Illuminate\Http\Request;

class TempStudInfoController extends Controller
{
    public function store(Request $request) {
        $user = $request->user();

        if($user->temp_stud_info_id || $user->stud_info_id) {
            return response()->json([
                'message' => 'The user is already bound to an existing student information'
            ]);
        }

        $request->validate([
            'lname' => 'required|string',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'addb' => 'required|string',
            'addt' => 'required|string',
            'addp' => 'required|string',
            'gender' => 'required|string',
            'status' => 'required|string',
        ]);

        $info = TempStudInfo::create($request->all());

        $user->update(['temp_stud_info_id'=>$info->id]);

        return response()->json([
            'message'=>'Temporary student information has been created.'
        ],201);
    }

    public function update(TempStudInfo $tempStudInfo) {

        $tempStudInfo->update(request()->all());

        return response()->json([
            'message' => 'Temporary student information updated successfully',
            'info' => $tempStudInfo
        ],201);
    }
}
