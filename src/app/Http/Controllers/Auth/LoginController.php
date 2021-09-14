<?php

namespace Sislamrafi\Admin\app\Http\Controllers\Auth;

use Sislamrafi\Admin\app\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = \Sislamrafi\Admin\AdminServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin::login', ['url' => 'admin']);
    }

    public function login(Request $request)
    {
        $valodator =  $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($e = $this->guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admin');
        }
        
        return back()
        ->withInput($request->only('email', 'remember'))
        ->withErrors(['email'=>"Email or password didn't match"
                    ]);
    }

    protected function guard()
    {
        return auth::guard('admin');
    }
    protected function broker()
    {
        return Password::broker('admins');
    }
}
/*
['errors'=>[
            'email'=>[
                'message'=>"email error"
            ]
        ]]
*/
