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
            // Key::edit($key->id, ['comment' => $request->input('name')]);
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
}
