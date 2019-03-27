<?php

namespace App\Http\Controllers;

use App\User;
use App\Team;
use Markdown;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function showProfile(Request $request, $username) {
        $user = User::where('name', $username)->first();
        if (empty($user)) {
            return abort(404);
        } else {
            return view('profile', ['user' => $user, 'bio' => Markdown::convertToHtml($user->bio)]);
        }
    }

    public function showTeam($teamname) {
        $team = Team::where('name', $teamname)->first();
        if (empty($team)) {
            return abort(404);
        } else {
            return view('profile.team', ['team' => $team, 'bio' => Markdown::convertToHtml($team->bio)]);
        }
    }
}
