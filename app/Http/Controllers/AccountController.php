<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\Customer;
use App\Models\CustomerResetToken;
use Illuminate\Http\Request;
use Mail;
use Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function login()
    {
        return view('account.login');
    }

    public function favorite()
    {
        // dd(auth('cus')->user()->favorites);
        $favorites = auth('cus')->user()->favorites ? auth('cus')->user()->favorites : [];
        return view('account.favorite', compact('favorites'));
    }

    public function logout()
    {
        auth('cus')->logout();
        return redirect()->route('account.login')->with('ok','You are Logout');
    }

    public function check_login(Request $req)
    {
        $req->validate([
            'email' => 'required|email|exists:customers',
            'password' => 'required',

        ]);

        $data = $req->only('email','password');

        $check = auth('cus')->attempt($data);

        if($check){
            if(auth('cus')->user()->email_verified_at == ''){
                auth('cus')->logout();
                return redirect()->back()->with('no','Your account is not Verify, please check email');
            }
            return redirect()->route('home.index')->with('ok','Welcome back');
        }
        return redirect()->back()->with('no','Your account invalid'); 
    }

    public function register()
    {
        return view('account.register');
    }

    public function check_register(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'confirm_password' => 'required|same:password',

        ],[
            'name.required' => 'Họ tên không được để trống',
            'name.min' => 'Họ tên tối thiểu là 6 ký tự'
        ]);

        $data = $req->only('name','email','phone','address','gender');

        $data['password'] = bcrypt($req->password);

        if($acc = Customer::create($data)){
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('ok','Register Successfully, please check your email to verify account');
        }
        
        return redirect()->back()->with('no','Something wrong, please try again');

    }

    public function verify($email){
        $acc = Customer::where('email',$email)->whereNull('email_verified_at')->firstOrFail();
        Customer::where('email',$email)->update(['email_verified_at'=> date('Y-m-d')]);
        return redirect()->route('account.login')->with('ok','Verify successfully, Now you can login');
    }

    public function change_password()
    {   
        return view('account.change_password');
    }

    public function check_change_password(Request $req)
    {
        $auth = auth('cus')->user();
        $req->validate([
            'old_password' => ['required',function($attr,$value,$fail) use($auth){
                if(!Hash::check($value,$auth->password)){
                    $fail('Your password is not match');
                }
            }],
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $data['password'] = bcrypt($req->password);
        if($auth->update($data)){
            $auth = auth('cus')->logout();
            return redirect()->route('account.login')->with('ok','Update your password successfully');
        }
        return redirect()->back()->with('no','Something wrong, please check again');

    }

    public function forgot_password()
    {
        return view('account.forgot_password');
    }

    public function check_forgot_password(Request $req)
    {
        $req->validate([
            'email' => 'required|email|exists:customers',
        ]);

        $customer = Customer::where('email', $req->email)->first();

        $token = \Str::random(40);
        $tokenData = [
            'email' => $req->email,
            'token' => $token
        ];
        
        if(CustomerResetToken::create($tokenData)){
            Mail::to($req->email)->send(new ForgotPassword($customer,$token));
            return redirect()->back()->with('ok','Send mail successfully, check your email');
        }

        return redirect()->back()->with('no','Something wrong, please check again');
        

    }

    public function profile()
    {
        $auth = auth('cus')->user();
        return view('account.profile', compact('auth'));
    }

    public function check_profile(Request $req)
    {
        $auth = auth('cus')->user();
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'.$auth->id,
            'password' => ['required', function($attr, $value, $fail) use($auth) {
                if(!Hash::check($value, $auth->password)){
                    return $fail('Your password is not match');
                }   
            }]

        ]);

        $data = $req->only('name','email','phone','address','gender');

        $check = $auth->update($data);
        if($check){
            return redirect()->back()->with('ok','Update your profile successfully');

        }
        return redirect()->back()->with('no','Something wrong, please check again');


    }

    public function reset_password($token)
    {
        $tokenData = CustomerResetToken::checkToken($token);
        // $customer = Customer::where('email',$tokenData->email)->firstOrFail();

        return view('account.reset_password');
    }

    public function check_reset_password($token)
    {
        request()->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        $tokenData = CustomerResetToken::checkToken($token);
        // $customer = Customer::where('email',$tokenData->email)->firstOrFail();
        $customer = $tokenData->customer;

        $data = [
            'password' => bcrypt(request(('password')))
        ];

        if($customer->update($data)){
            return redirect()->back()->with('ok','Update your password successfully');

        }
        return redirect()->back()->with('no','Something wrong, please check again');

    }
}
