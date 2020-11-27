<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function sendEmailLink(Request $request)
    {
        $email = $request->email;
        $token = $this->createToken($email);

        $this->saveToken($email, $token);

        Mail::send('mail.password-reset',[
            'token' => $token
        ], function ($message) use ($email) {
            $message->to($email);
            $message->subject('LaraGuard Password Notification');
        });

        return redirect('/');
    }

    private function createToken(string $email)
    {
        $tokenContent = Str::random(64);
        $tokenEmail = base64_encode($email);

        $token = "{$tokenContent}::{$tokenEmail}";

        return $token;
    }

    private function saveToken($email, $token)
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }
}
