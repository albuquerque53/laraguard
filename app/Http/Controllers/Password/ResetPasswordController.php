<?php

namespace App\Http\Controllers\Password;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $email = $request->email;
        $newPassword = Hash::make($request->password);

        Student::where('email', $email)
            ->update(['password' => $newPassword]);

        $this->dropResetRow($email);
        return redirect('/');
    }

    public function confirmToken($token)
    {
        $email = $this->getEmailFromToken($token);
        $passwordResetRow = DB::
            table('password_resets')
            ->where('email', '=', $email)
            ->first();

        if (!$passwordResetRow || $passwordResetRow->token !== $token) {
            echo json_encode([
                'message' => 'Invalid token'
            ]);
            exit();
        }

        return view('auth.reset-password', ['email' => $email]);
    }
    
    private function getEmailFromToken(string $token)
    {
        $explodedToken = explode('::', $token);
        $email = base64_decode($explodedToken[1]);

        return $email;
    }

    private function dropResetRow(string $email)
    {
        DB::table('password_resets')->where('email', '=', $email)->delete();
    }
}
