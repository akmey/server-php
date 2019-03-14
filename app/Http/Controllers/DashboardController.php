<?php

namespace App\Http\Controllers;

use Hash;
use App\Key;
use Illuminate\Http\Request;
use App\Http\Requests\EditProfile;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function edit(Request $request, $keyid) {
        $key = Key::find($keyid);
        if (empty($key)) {
            abort(404);
        }
        if ($key->user != Auth::User()) {
            abort(403);
        } else {
            return view('edit', ['key' => $key, 'status' => null]);
        }
    }

    public function editPost(Request $request, $keyid) {
        $key = Key::find($keyid);
        if (empty($key)) {
            abort(404);
        }
        if ($key->user != Auth::User()) {
            abort(403);
        } else {
            $key->comment = $request->input('name');
            $key->save();
            return view('edit', ['key' => $key, 'status' => 'Saved!']);
        }
    }

    public function delete($keyid) {
        $key = Key::find($keyid);
        if (empty($key)) {
            abort(404);
        }
        if ($key->user != Auth::User()) {
            abort(403);
        } else {
            $key->delete();
            return redirect('dashboard');
        }
    }

    public function apps() {
        return view('oauthapps');
    }

    public function editProfile() {
        return view('edit-profile', ['status' => null, 'error' => null]);
    }

    public function editProfilePost(EditProfile $request) {
        $user = Auth::user();
        if (Hash::check($request->input('oldpasswd'), $user->password)) {
            $tochange = $request->validated();
            if (!empty($tochange['username'])) {
                $user->name = $tochange['username'];
            }
            if (!empty($tochange['email'])) {
                $user->email = $tochange['email'];
            }
            if (!empty($tochange['password'])) {
                $user->password = Hash::make($tochange['password']);
            }
            if (!empty($tochange['profilepic'])) {
                $user->profilepic = $tochange['profilepic']->store('profilepics', 'public');
            }
            $user->save();
            return view('edit-profile', ['status' => 'Saved!', 'error' => null]);
        } else {
            return view('edit-profile', ['status' => null, 'error' => 'Wrong old password']);
        }
    }
}
