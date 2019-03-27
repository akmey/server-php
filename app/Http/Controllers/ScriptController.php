<?php

namespace App\Http\Controllers;

use App\User;
use App\Team;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function getUserScript($username) {
        $user = User::where('name', $username)->first();
        if (!$user) {
            return abort(404);
        } else {
            return response()
                ->view('script', ['user' => $user])
                ->header('Content-Type', 'text/x-shellscript');
        }
    }

    public function getTeamScript($teamname) {
        $team = Team::where('name', $teamname)->first();
        if (!$team) {
            return abort(404);
        } else {
            return response()
                ->view('teamscript', ['team' => $team])
                ->header('Content-Type', 'text/x-shellscript');
        }
    }
}
