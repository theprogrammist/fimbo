<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Page;
use App\Problem;
use Validator;
use Auth;
use Log;
use App;
use Hash;
use App\Action;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        return view('cabinet-settings', ['user' => Auth::user(),
        ]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make(array_merge($request->all()),
            [
                'avatar' => 'max:1024',
                'url' => 'max:1024',
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.Auth::user()->id,
                'password' => 'min:6',
            ]
        );

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if ($request->has('password')) {
            Auth::user()->password = Hash::make($request->input('password'));
        }

        if ($request->has('newsletters')) {
            Auth::user()->newsletters = true;
        } else {
            Auth::user()->newsletters = false;
        }

        Auth::user()->name = $request->input('name');
        Auth::user()->email = $request->input('email');
        Auth::user()->soctype = $request->input('soctype');
        Auth::user()->url = $request->input('url');
        Auth::user()->save();

        if(!empty(Auth::user()->url)) {
            if(Auth::user()->account()->count() == 0 || Auth::user()->account->actions()->wherePricetypeId(App\Pricetype::whereCode('profile')->first()->id)->count() == 0) {
                Action::addAction('profile');
            }
        }

        return redirect('/settings/')
            ->with([
                'message' => 'Изменения сохранены',
            ]);
    }

}
