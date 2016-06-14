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
    public function confirm($confirmationCode)
    {
        if (!$confirmationCode) {
            return view('auth.confirmation-code')
                ->with('resultClass', 'result-class-error')
                ->with('response', 'Не указан код подтверждения');
        }

        $user = User::whereConfirmationCode($confirmationCode)->first();

        if (!$user) {
            return view('auth.confirmation-code')
                ->with('resultClass', 'result-class-error')
                ->with('response', 'Неправильный код подтверждения');
        }

        $user->confirmed = 1;
        //$user->confirmation_code = null;
        $user->save();

        //Flash::message('You have successfully verified your account.');
        return view('auth.confirmation-code')
            ->with('resultClass', 'result-class-success')
            ->with('response', 'Ваша электронная почта успешно подтверждена');

        //return Redirect::route('login_path');
    }
}
