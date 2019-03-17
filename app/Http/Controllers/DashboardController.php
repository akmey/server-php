<?php

namespace App\Http\Controllers;

use Hash;
use App\Key;
use Storage;
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
        if (Auth::user()->can('update', $key)) {
            return view('edit', ['key' => $key, 'status' => null]);
        } else {
            abort(403);
        }
    }

    public function editPost(Request $request, $keyid) {
        $key = Key::find($keyid);
        if (empty($key)) {
            abort(404);
        }
        if (Auth::user()->can('update', $key)) {
            $key->comment = $request->input('name');
            $key->save();
            return view('edit', ['key' => $key, 'status' => 'Saved!']);
        } else {
            abort(403, 'You cannot edit this key.');
        }
    }

    public function delete($keyid) {
        $key = Key::find($keyid);
        if (empty($key)) {
            abort(404);
        }
        if (Auth::user()->can('delete', $key)) {
            $key->delete();
            return redirect('dashboard');
        } else {
            abort(403, 'You cannot delete this key.');
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
            if (!empty($tochange['bio'])) {
                $user->bio = $tochange['bio'];
            }
            if (!empty($tochange['profilepic'])) {
                if ($user->profilepic != 'default.png') {
                    Storage::disk('public')->delete($user->profilepic);
                }
                $user->profilepic = $tochange['profilepic']->store('profilepics', 'public');
            }
            $user->save();
            return view('edit-profile', ['status' => 'Saved!', 'error' => null]);
        } else {
            return view('edit-profile', ['status' => null, 'error' => 'Wrong old password']);
        }
    }
}
