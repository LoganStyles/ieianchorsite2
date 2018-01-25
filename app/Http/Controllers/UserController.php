<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController {  
    
    public function __construct(){
        parent::__construct();
//        $this->middleware('auth');
    }
    
    public function index() {
        $users = DB::table('users')
                ->leftjoin('userimages', 'users.id', '=', 'userimages.itemid')
                ->leftjoin('roles', 'users.role', '=', 'roles.id')
                ->select('users.*', 'roles.title as role_title', 'userimages.filename', 'userimages.itemid as imageid', 'userimages.alt', 'userimages.caption', 'userimages.main')
                ->where('users.role', '>', 1)
                ->orderBy('users.id', 'asc')
                ->get();
        $arrays = [];
        foreach ($users as $object) {
            $arrays[] = (array) $object;
        }
        return view('/backend/users', ['users' => $arrays, 'page_name' => 'personnel']);
    }
    
    public function showUserGroups() {
        $usergroups = DB::table('roles')
                ->where('id', '>', 1)
                ->orderBy('id', 'asc')
                ->get();
        $arrays = [];
        foreach ($usergroups as $object) {
            $arrays[] = (array) $object;
        }
        return view('/backend/roles', ['usergroups' => $arrays, 'page_name' => 'role']);
    }
    
    public function processUserGroups(Request $request) {
        
        if ($request['id'] > 0) {
            Role::where('id', $request['id'])->update([
                'title' => $request['title'],
                'description' => trim($request['description']),
                'user' => $request['user'],
                'role' => $request['role'],
                'management' => $request['management'],
                'board' => $request['board'],
                'newsitem' => $request['newsitem'],
                'testimonial' => $request['testimonial'],
                'service' => $request['service'],
                'about' => $request['about'],
                'report' => $request['report'],
                'delete_group' => $request['delete_group']
            ]);
        } else {
            
            $this->validate($request, [
                'title' => 'required|unique:roles'
            ]);
            //insert aboutitems
            $role = new Role();
            $role->title = $request['title'];
            $role->description = trim($request['description']);
            $role->user = $request['user'];
            $role->role = $request['role'];
            $role->management = $request['management'];
            $role->board = $request['board'];
            $role->newsitem = $request['newsitem'];
            $role->testimonial = $request['testimonial'];
            $role->service = $request['service'];
            $role->about = $request['about'];
            $role->report = $request['report']; 
            $role->delete_group = $request['delete_group'];
            $role->save();
        }
        return redirect()->route('show_usergroups');
    }
    
    
    /* display roles in create administrator page */
    public function createAdmin() {
        $users = DB::table('roles')
                ->select('*')
                ->where('id', '>', 1)
                ->orderBy('id', 'asc')
                ->get();
        $arrays = [];
        foreach ($users as $object) {
            $arrays[] = (array) $object;
        }
        return view('/backend/create_user', ['roles' => $arrays]);
    }

/* create a user based on selected role */

    public function postCreateUser(Request $request) {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'firstname' => 'required|max:120',
            'lastname' => 'required|max:120',
            'password' => 'required|min:6'
        ]);

        $user = new User();
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->name = $request['firstname'] . " " . $request['lastname'];
        $user->password = bcrypt($request['password']);

        $user->save();

        return redirect()->route('show_users');
    }    
    
    /* confirm that user is not logged in
     * 
     * confirm that email & password exist,
     * get role for this user
     * store role data in session
     */
    public function postLoginUser(Request $request) {
        if (!$this->isLoggedIn()) {//not already logged in
            //validate params
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);

            //attempt login
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

                /*show dashboard*/
                return view('/backend/dashboard', [
                    'prices' => $this->latest_prices,
                    'page_name' => 'dashboard'
                ]);
            }else{
                //user not found:set errors & redirect
//                echo 'user not found';exit;
                return redirect()->route('login');
            }
            
        } else {
            //return back since already logged in
//            return redirect()->back();
            return view('/backend/dashboard', [
                    'prices' => $this->latest_prices,
                    'page_name' => 'dashboard'
                ]);
        }
    }

    public function logoutUser() {       
        Auth::logout();
//        $request->session()->flush();
        return redirect()->route('login');
    }
}

