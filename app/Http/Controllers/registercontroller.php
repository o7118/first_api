<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerrequest;
use App\Http\Resources\registerresource;
use App\Mail\otp;
use App\Models\otp as ModelsOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;

class registercontroller extends Controller
{
    public function registerone(registerrequest $request)
    {
        $user = User::create
        ([
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
            'number' => $request->number,
            'verified_at' => false
        ]);
        
        $otpcode = rand(1000, 9999);

        ModelsOtp::create
        ([
            'otp'=>$otpcode,
            'expired_at' => Carbon::now()->addMinutes(5),
            'user_id' => $user->id
        ]);

        Mail::to($request->email)->send(new otp($otpcode, $otpcode));

        return response()->json(['message' => 'otp sent successfully', new registerresource($user)]);
    }



    public function registerotp(Request $request)
    {
        $email = request('email');
        $user = User::where('email', $email)->first();
        if(!$user)
        {
            return response()->json(['message' => 'invalid email']);
        }

        if($user->verified_at)
        {
            return response()->json(['message' => 'email already verified, proceed to login']);
        }

        $otp = ModelsOtp::where('user_id', $user->id)->first();
        $otpcode = $otp->otp;

        if($request->otp == $otpcode)
        {
            if(Carbon::now()->greaterThan($otp->expired_at))
            {
                return response()->json(['message' => 'otp expired, request new otp',]);
            }
            
            else
            {
                $user->verified_at = true;
                $user->save();
                return response()->json(['message' => 'otp correct, email varified',]);
            }
        }

        else
        {
            return response()->json(['message'=> 'wrong otp']);
        }
    }


    public function resendotp()
    {
        $email= request('email');
        $user = User::where('email', $email)->first();
        $otpcode = rand(1000, 9999);
        $otptable = ModelsOtp::where('user_id', $user->id)->first();
        if($otptable)
        {
            $otptable->otp=$otpcode;
            $otptable->expired_at = Carbon::now()->addMinutes(5);
            $otptable->save();
        }
        Mail::to($email)->send(new otp($otpcode, $otpcode));

        return response()->json(['message' => 'otp sent, would expire in 5 min']);
    }
}
