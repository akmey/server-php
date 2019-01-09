<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Key;

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
        $keys = Key::getByUser(Auth::User());
        return view('home', ['keys' => $keys]);
    }

    public function edit(Request $request, $keyid) {
        $user = Auth::User();
        $key = Key::getById($keyid);
        if (empty($key)) {
            abort(404);
        }
        if ($key->userid != $user->id) {
            abort(403);
        } else {
            return view('edit', ['key' => $key, 'status' => null]);
        }
    }

    public function editPost(Request $request, $keyid) {
        $user = Auth::User();
        $key = Key::getById($keyid);
        if (empty($key)) {
            abort(404);
        }
        if ($key->userid != $user->id) {
            abort(403);
        } else {
            Key::edit($key->id, ['comment' => $request->input('name')]);
            return view('edit', ['key' => Key::getById($keyid), 'status' => 'Saved!']);
        }
    }

    public function delete($keyid) {
        $user = Auth::User();
        $key = Key::getById($keyid);
        if (empty($key)) {
            abort(404);
        }
        if ($key->userid != $user->id) {
            abort(403);
        } else {
            Key::delete($key->id);
            return redirect('dashboard');
        }
    }

    public function apps() {
        return view('oauthapps');
    }
}
