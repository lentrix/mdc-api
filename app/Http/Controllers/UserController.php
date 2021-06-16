<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function info() {
        $user = auth()->user();
        $info = [];

        if($user->stud_info_id) {
            $info = DB::table('stud_info')->where('idnum', $user->stud_info_id)->first();
            if($info) {
                return response()->json([
                    'info' => $info
                ],200);
            }
        }

        if($user->temp_stud_info_id) {
            $info = DB::table('temp_stud_infos')->where('id', $user->temp_stud_info_id)->first();

            if($info) {
                return response()->json([
                    'info' => $info
                ],200);
            }
        }

        return response()->json([
            'message' => 'No info'
        ],404);
    }

    public function basicInfo() {
        $user = auth()->user();
        $info = [];

        if($user->stud_info_id) {
            $info = DB::table('stud_info')->where('idnum', $user->stud_info_id)
                    ->select(['lname','fname','mi'])->first();
            if($info) {
                return response()->json([
                    'basicInfo' => $info
                ],200);
            }
        }

        if($user->temp_stud_info_id) {
            $info = DB::table('temp_stud_infos')
                    ->where('id', $user->temp_stud_info_id)
                    ->select(['lname','fname','mname'])
                    ->first();

            if($info) {
                return response()->json([
                    'basicInfo' => $info
                ],200);
            }
        }

        return response()->json([
            'message' => 'No info'
        ],404);
    }

    public function update(User $user, Request $request) {
        try {
            $user->update($request->all());

            return response()->json([
                'user' => $user
            ],202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 422);
        }
    }
}
