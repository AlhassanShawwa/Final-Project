<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

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
            // 'last_name' => ['required', 'string', 'max:255'],
            // 'phone' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return Patient::create([
            'first_name' => $data['name'],
            'last_name' => $data['name'],
            'phone' => '+972592324370',
            'image' => 'asdadsasd.jpg',
            'address' => 'mmmmmm',
            'date_of_birth' => '2024-08-02 10:42:50',

            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // return Patient::create([
        //     'first_name' => 'mohammed',
        //     'last_name' => 'alsersawi',
        //     'phone' => '+972592324370',
        //     'image' => 'asdadsasd.jpg',
        //     'email' => 'm.f.alsersawi@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'gender' => 'male',
        //     'address' => 'mmmmmm',
        //     'date_of_birth' => '26/12/2201',
        // ]);
    }
}
