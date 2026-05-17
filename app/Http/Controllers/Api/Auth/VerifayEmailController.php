<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\Api\SendOtpRegister;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class VerifayEmailController extends Controller
{
    protected $otp;
    public function __construct()
    {
        $this->otp = new Otp;
    }
    public function verifay(Request $request)
    {
        $request->validate(['Code' => 'required']);
        $user = $request->user();
        $code = $request->Code;
        $check = $this->otp->validate($user->email, $code);
        if ($check->status == false) {
            return apiResponse(404, 'Otp is invailed');
        }

        $user->update(['email_verified_at' => now()]);
        return apiResponse(200, 'Email Verfiad Success');
    }
    public function sendOtpAgain()
    {
        $user = request()->user();
        $user->notify(new SendOtpRegister());
        return apiResponse(200, 'Otp send Success');
    }
}
