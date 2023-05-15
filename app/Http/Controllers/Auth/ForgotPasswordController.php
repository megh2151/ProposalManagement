<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendPasswordResetLink(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        // Handle the response
        if ($response == Password::RESET_LINK_SENT) {
            return redirect()->back()->with('status', 'Password reset link sent to your email!');
        } else {
            return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }
}
