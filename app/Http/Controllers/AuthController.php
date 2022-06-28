<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTFactory;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['login','register','index']]);
    }

    public function index() {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return redirect('/index')->with('error', 'Unauthorized');
        }
        $user = Auth::user();
        $customClaims = ['sub' => $user->id, 'role'=> $user->is_admin];
        $jwttoken = JWTAuth::fromUser($user);
        // $jwttoken = JWTAuth::attempt($credentials);
        // $jwttoken = JWTAuth::encode($payload);
        // $jwttoken = auth('api')->attempt($credentials);

        if ($user->is_admin)
            return redirect('/')->with('success', 'You are login')->withCookie('jwt',$jwttoken);
        return redirect('/equipment_user/' . $user->id)->with('success', 'You are login');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'gender' => 'required',
        ]);

        $input = $request->only(['name','email','password','gender','birthdate']);

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'gender'   => $input['gender'],
            'birthdate' => '2000-2-2'
        ]);

        $user = new User;

        $token = Auth::login($user);
        return redirect('/')->with('success', 'User created successfully');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('success', 'Logged out');
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function test(User $user)
    {
        return response()->json([
            'status' => 'success',
            'fullname' => $user->fullname
        ]);
    }

}
