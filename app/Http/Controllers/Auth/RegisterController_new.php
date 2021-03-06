<?php

namespace App\Http\Controllers\Auth;

use Vanguard\Repositories\Country\CountryRepository;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Tenant;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'company' => ['required', 'string'],

        ]);
    }



    public function showRegistrationForm()
    {

        $arr['tenants'] = Tenant::where('tm_status', 1)->orderBy('tm_name', 'asc')->get();
        return view('auth.register')->with($arr);
    }

    public function edit(User $user)
    {
        $arr['user'] = Auth::user();
        return view('users.edit')->with($arr);
    }


    public function update(Request $request, User $user)
    {
        $user->name = request('name');
        $user->save();
        return back();
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */






    public function create()
    {
        return view('mall.tenant.create');
    }

    public function store(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->company = $request->company;
        $user->dept = $request->dept;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);









        $user->save();
        return redirect('mall/tenant')->with('success', 'Transaction created successfully!');
    }
}
