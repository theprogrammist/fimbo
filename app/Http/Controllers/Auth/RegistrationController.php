<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * @param $confirmationCode
     * @return \Illuminate\Http\Response
     * @throws InvalidConfirmationCodeException
     */
    public function confirm($confirmationCode = false)
    {
        if (!$confirmationCode) {
            return view('auth.register-success-confirmation')
                ->with('resultClass', 'active')
                ->with('resultMessage', 'Не указан код подтверждения');
        }

        $user = User::whereConfirmationCode($confirmationCode)->first();

        if (!$user) {
            return view('auth.register-success-confirmation')
                ->with('resultClass', 'active')
                ->with('resultMessage', 'Неправильный код подтверждения');
        }

        $user->confirmed = 1;
        //$user->confirmation_code = null;
        $user->save();

        return view('auth.register-success-confirmation')
            ->with('resultClass', 'active-done')
            ->with('resultMessage', 'Ваша электронная почта успешно подтверждена.');

        //return Redirect::route('login_path');
    }
}
