<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

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

        if ($user->confirmed) {
            return view('auth.register-success-confirmation')
                ->with('resultClass', 'active-done')
                ->with('resultMessage', 'Ваша электронная почта уже была успешно подтверждена.');
        }

        $user->confirmed = 1;
        //$user->confirmation_code = null;
        $user->save();

        Auth::guard($this->getGuard())->login($user);

        return view('auth.register-success-confirmation')
            ->with('resultClass', 'active-done')
            ->with('resultRedirect', '/')
            ->with('resultMessage', 'Ваша электронная почта успешно подтверждена. Через 5 секунд вы будете перенаправлены на страницу вашего профиля.');

        //return Redirect::route('login_path');
    }
}
