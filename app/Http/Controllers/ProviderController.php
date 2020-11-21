<?php

namespace App\Http\Controllers;

use Illuminate\{ Http\Request, Support\Facades\Auth };
use Laravel\Socialite\Facades\Socialite;
use App\Models\Student;

class ProviderController extends Controller
{
    private $driver;

    public function __construct(Request $request)
    {
        $routePrefix = $request->route()->action['prefix'];
        $this->driver = substr($routePrefix, 1);
    }

    public function redirectToProvider(Request $request)
    {
        return Socialite::driver($this->driver)->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver($this->driver)->user();
        } catch (\Exception $e) {
            return redirect('/');
        }

        $existingUser = Student::where('email', $user->email)->first();
        $providerColumn = "{$this->driver}_id";

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            $newUser = new Student;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->$providerColumn = $user->id;
            $newUser->save();

            Auth::login($newUser, true);
        }

        return redirect('/');
    }
}
