<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/backend/dashboard';
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function checkLoginUser(){
        
//        echo 'id '. (Auth::id());exit;
        
        if (Auth::check()) {
    // The user is logged in...
            echo 'logged in';exit;
        }else{
            echo 'not logged in';exit;
        }
        
        
    }
    
    public function logoutUser() {
        echo 'inside logout';exit;
        Auth::logout();
        return redirect()->route('/ops');
    }
    
    public function postLoginUser(Request $request) {
        /*login an admin*/

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['password' => $request['password']], ['email' => $request['email']])) {
            //get role & store in session
            $user = DB::table('users')
                    ->leftjoin('roles', 'users.role', '=', 'roles.id')
                    ->select('users.name', 'users.email', 'roles.*')
                    ->where('users.email', '=', $request['email'])
                    ->limit(1)
                    ->get();
            session(['users_fullname' => $user[0]->name]);
            session(['users_email' => $user[0]->email]);
            session(['users' => $user[0]->user]);
            session(['delete_group' => $user[0]->delete_group]);
            session(['roles' => $user[0]->role]);
            session(['management' => $user[0]->management]);
            session(['board' => $user[0]->board]);
            session(['newsitem' => $user[0]->newsitem]);
            session(['testimonial' => $user[0]->testimonial]);
            session(['service' => $user[0]->service]);
            session(['about' => $user[0]->about]);
            session(['reports' => $user[0]->report]);
            
            $arrays = [];
            foreach ($user as $object) {
                $arrays[] = (array) $object;
            }
            //GET unit prices
            $latest_prices=DB::table('unit_prices')
                        ->orderBy('report_date','desc')
                        ->first();
            
                return view('/backend/dashboard', ['userinfo' => $arrays,
                'prices' => $latest_prices,
                'page_name' => 'dashboard'
            ]);
        }else{
            return view('backend/login');
        }
        return redirect()->back();
    }
}
