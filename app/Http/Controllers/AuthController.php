<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use Exception;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function login(Request $request){
        //dd($request->all());
      
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }
    
      
        return redirect()->back()->with('error', 'Invalid login details. Please try again.');
    }


    public function store(Request $request)
    {
     // dd($request->all());
      //  exit();
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'country_id' => 'required|exists:countries,id', 
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
        
        ]);
    
        try {
            $user = new User();
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->gender = $request->gender;
            $user->dob = $request->dob;
             $user->country_id = $request->country_id;
            $user->state_id = $request->state_id;
            $user->city_id = $request->city_id;
            $user->save();
           
            Mail::to($user->email)->send(new WelcomeEmail($user));
            return response()->json(['success' => true, 'message' => 'Registration successful!']);
        } catch (Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage() 
            ]);
        }

        if(Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }

        return redirect('register')->withError('Error');
}

       public function view()
       {
        $user = Auth::user();
        $user->country_name = DB::table('countries')->where('id', $user->country_id)->value('name');
        $user->state_name = DB::table('states')->where('id', $user->state_id)->value('name');
        $user->city_name = DB::table('cities')->where('id', $user->city_id)->value('name');
        return view('welcome', compact('user'));
       }

       public function logout(){
              \Session::flush();
              \Auth::logout();
              return redirect()->route('login');
      }

}
