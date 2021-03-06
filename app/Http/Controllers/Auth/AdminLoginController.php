<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest:admin');
  }
    public function showLoginForm()
    {
      return view ('auth.admin-login');
    }
    public function login(Request $request)
    {
      //Validation
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);
      //Attempt to log in
      if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)) {
        //Redirect to intended location
        return redirect()->intended(route('manage.dashboard'));
      }
      //Not match or an error
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
