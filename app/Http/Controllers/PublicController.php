<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PublicController extends Controller
{
    public function showProfile(Request $request, $username) {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            return abort(404);
        } else {
            return view('profile', ['user' => $user]);
        }
    }
}
