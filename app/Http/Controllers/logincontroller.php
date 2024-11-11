<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginrequest;
use App\Http\Resources\loginresource;
use App\Http\Resources\registerresource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class logincontroller extends Controller
{
    public function login(loginrequest $request)
    {
        $detail = User::where('email', $request->email)->first();

        if($detail)
        {
            if (Hash::check($request->password, $detail->password))
            {
                if($detail->verified_at)
                {
                    Auth::user($detail);
                    return response()->json(['message' => 'login successfull', new loginresource($detail)]);   
                }

                else
                {
                    return response()->json(['message' => 'account unverified, proceed to verification']);
                }
            }
            else
            {
                return response()->json(['message' => 'incorrect password']);
            }
        }

        else
        {
            return response()->json(['message' => 'invalid email']);
        }
    }

    public function userlog(loginrequest $request){
        return response()->json(['gog abeg'=>'yeee']);
    }
}
