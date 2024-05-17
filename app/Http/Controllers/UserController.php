<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Auth.login');
    }

    public function register()
    {
        return view('Auth.register');
    }

    public function reg_user(Request $request)
    {
        // dd('here');

        $validator = Validator::make($request->all(), [

            "name"  => "required",
            "email"  => "required|unique:users,email",
            "password"  => "required",


        ]);
        if ($validator->fails()) {
            // return Redirect::back()->withErrors($validator);
            return response()->json(['status' => 'success', 'success_code' => '201', 'message' => $validator->errors()->first()]);
        } else {
            $res = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];

            // dd($res);
            $user =  User::create($res);
            //   dd( $user);
            if ($user) {
                return response()->json(['status' => 'success', 'success_code' => '200']);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        $email = $request->email;

        $password = $request->password;
        // dd( $password);
        if (auth()->attempt(['email' => $email, 'password' => $password])) {

            $id =  Auth::user()->id;
            $res = [
                'user_id' =>   $id
            ];

            // dd($res);
            $user =  UserAccess::create($res);


            return response()->json(['status' => 'success', 'success_code' => '200']);
        } else {
            return response()->json(['status' => 'error', 'success_code' => '201']);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function home()
    {
        // $users=UserAccess::with('users')->groupBy('user_id')->get();
        $users= DB::table('users_access')
                 ->select('user_id', DB::raw('count(*) as total'))
                 ->groupBy('user_id')
                 ->get();

        // dd($users->toArray());
        return view('home',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
