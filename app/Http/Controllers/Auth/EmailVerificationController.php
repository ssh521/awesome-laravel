<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    /**
     * 이메일 인증
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->to('/');
    }

    /**
     * 이메일이 인증되지 않은 경우
     *
     * @return \Illuminate\View\View
     */
    public function notice()
    {
        return view('auth.verify-email');
    }

    /**
     * 인증 이메일 재전송
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        $user = $request->user();

        $user->sendEmailVerificationNotification();

        return back();
    }
}
