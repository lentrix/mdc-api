<?php

namespace App\Http\Controllers;

use App\Models\TempStudInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request) {
        $creds = $request->only(['user','password']);

        if(! $token = auth()->attempt($creds)) {
            return response()->json(['error'=>'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me() {
        return response()->json(auth()->user());
    }

    public function logout() {
        auth()->logout();
        return response()->json(['message'=>'Successfully logged out']);
    }

    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }

    public function register(Request $request) {
        $request->validate([
            'lname' => 'required|string',
            'fname' => 'required|string',
            'mname' => 'required|string',
            'email' => 'required|confirmed|string|email|unique:online_users,email',
            'user' => 'required|string|unique:online_users,user',
            'password' => 'required|string'
        ]);

        $mi = substr($request->mname, 0, 1);
        $info = DB::table('stud_info')
            ->where('lname', $request->lname)
            ->where('fname', $request->fname)
            ->where('mi', 'like', "$mi%")
            ->first();

        if($info) {
            if($this->isBound($info)) {
                return response()->json([
                    'message' => "The record of $request->lname, $request->fname is already bound to an existing user."
                ], 422);
            }
            User::create([
                'user' => $request->user,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'student',
                'stud_info_id' => $info->idnum
            ]);
        }else {
            $tempInfo = TempStudInfo::create([
                'lname' => $request->lname,
                'fname' => $request->fname,
                'mname' => $request->mname,
            ]);

            User::create([
                'user' => $request->user,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'student',
                'temp_stud_info_id' => $tempInfo->id
            ]);
        }

        $token = auth()->attempt(['user'=>$request->user, 'password'=>$request->password]);
        return $this->respondWithToken($token);
    }

    private function isBound($info) {
        $user = User::where('stud_info_id', $info->idnum)->first();
        return $user;
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
