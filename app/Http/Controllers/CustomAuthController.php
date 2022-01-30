<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{

    // Home page
    public function index()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    // User Login Post
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }


    // User Registration Get
    public function registration()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }
        return view('auth.registration');
    }

    // User Registration Post
    public function customRegistration(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required_with:confirm_password|same:confirm_password|min:6',
            'confirm_password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    // function for Create User 
    public function create(array $data)
    {
        return User::create([
            'fullname' => $data['fullname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    // Show Dashboard 
    public function dashboard()
    {
        if (Auth::check()) {
            $userData = Auth::user()->getAttributes();
            $allUser = User::where('id', '!=', $userData['id'])->get()->toArray();
            return view('dashboard')->with('allUser', $allUser);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    // Show Profile 
    public function profile()
    {
        if (Auth::check()) {
            $userData = Auth::user()->toArray();
            return view('profile')->with("userData", $userData);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }


    // update Profile 
    public function profileUpdate(Request $request)
    {
        if ($request->file('profile_image')) {
            $image = $request->file('profile_image');
            $destinationPath = 'uploads/';
            $profile_image = date('mdHis') .  "." . $image->getClientOriginalExtension();
            $image_file = Image::make($image->getRealPath());
            $image_file->fit(140, 140, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . $profile_image);
            $request->profile_image = $profile_image;
        }

        if (Auth::check()) {
            $data = $request->all();
            $request->validate([
                'current_password' => 'required|min:6',
                'password' => 'required_with:confirm_password|same:confirm_password|min:6',
                'confirm_password' => 'required|min:6',
            ]);
            $userData = Auth::user()->getAttributes();
            if (Hash::check($data['current_password'], $userData['password'])) {

                User::where('id', $userData['id'])
                    ->update([
                        'fullname' => $data['fullname'],
                        'username' => $data['username'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'bio' => $data['bio'],
                        'profile_image' => isset($profile_image) ? $profile_image : null,
                    ]);
            }
            $updatedUserData = User::where('id', $userData['id'])->first()->toArray();
            return view('profile')->with("userData", $updatedUserData);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }



    // Delete Profile 
    public function ProfileDestroy($id)
    {
        if (Auth::check()) {
            User::where('id', $id)->delete();
            return Redirect('dashboard');
        }
        return redirect("login");
    }

    // Change users Profile details 
    public function ProfileChange(Request $request, $id)
    {
        if (Auth::check()) {
            $userData = Auth::user()->getAttributes();
            if (Hash::check($request['password'], $userData['password'])) {
                $data = $request->all();
                unset($data['_token']);
                User::where('id', $id)
                    ->update($data);
                return Redirect('dashboard');
            }
        }
        return redirect("login");
    }

    // User signOut
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
