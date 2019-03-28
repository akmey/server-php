<?php

namespace App\Http\Controllers;

use Auth;
use App\Team;
use App\User;
use App\TeamInvitation;
use Illuminate\Http\Request;
use App\Http\Requests\EditTeam;

class TeamController extends Controller
{
    /**
     * Create team
     */
    public function createTeam() {
        return view('team.create');
    }

    public function createTeamPost(Request $request) {
        $request->validate([
            'name' => 'required|string|unique:teams|regex:/^[A-Za-z0-9]+$/',
            'bio' => 'required',
            'adminopen' => ['required', 'string', 'regex:/^yes|no$/']
        ]);
        // Okay, we create a team and we add the user to it.
        $team = Team::create([
            'name' => $request->input('name'),
            'bio' => $request->input('bio'),
            'creator_id' => Auth::id(),
            'adminopen' => $request->input('adminopen') == 'yes' ? true:false
        ]);

        $team->users()->attach(Auth::id());

        return redirect()->route('profile.team', ['name' => $team->name]);
    }

    /**
     * Admin panel for teams
     */
    public function adminTeam($teamid) {
        $team = Team::findOrFail($teamid);
        if (Auth::user()->can('update', $team)) {
            return view('team.admin', ['team' => $team, 'status' => '']);
        } else {
            return abort(401);
        }
    }

    public function adminTeamPost(EditTeam $request, $teamid) {
        $team = Team::findOrFail($teamid);
        foreach ($request->input() as $key => $value) {
            if ($key == '_token' || $value == null) {
                continue;
            }
            if ($key == 'adminopen') {
                if (Auth::user()->can('permUpdate', $team)) {
                    switch ($value) {
                        case 'yes':
                            $team->adminopen = true;
                            break;

                        case 'no':
                            $team->adminopen = false;
                            break;

                        default:
                            return abort(422);
                            break;
                    }
                }
                continue;
            }
            $team->{$key} = $value;
        }
        $team->save();
        return view('team.admin', ['team' => $team, 'status' => __('team.form.saved')]);
    }

    /**
     * Invite a member
     */

    public function addMember(Request $request, $teamid) {
        $team = Team::findOrFail($teamid);
        $user = User::where('name', $request->input('username'))->first();
        if (empty($user)) {
            return response()->json('notfound', 404);
        }
        $ti = TeamInvitation::where([
            ['user_id', $user->id],
            ['team_id', $team->id]
        ])->first();
        if ($team->users->contains($user)) {
            return response()->json('inteam', 422);
        }
        if (empty($ti)) {
            $ti = new TeamInvitation;
            $ti->user()->associate($user);
            $ti->team()->associate($team);
            $ti->save();
            return response()->json('OK');
        } else {
            return response()->json('already', 422);
        }
    }

    public function acceptInvitation($invitationid) {
        $ti = TeamInvitation::findOrFail($invitationid);
        if ($ti->user->id != Auth::id()) {
            return abort(401);
        }
        $ti->team->users()->attach(Auth::id());
        $ti->delete();
        return redirect()->back()->with('status', __('dashboard.team.welcome', ['team' => $ti->team->name]));
    }

    public function ignoreInvitation($invitationid) {
        $ti = TeamInvitation::findOrFail($invitationid);
        if ($ti->user->id != Auth::id()) {
            return abort(401);
        }
        $ti->delete();
        return redirect()->back();
    }

    /**
     * Kick a member
     */
    public function kickMember($teamid, $userid) {
        $team = Team::findOrFail($teamid);
        $user = User::findOrFail($userid);
        if ($team->users->contains($user) && Auth::user()->can('kickMember', $team)) {
            $team->users()->detach($user->id);
            return redirect()->back();
        } else {
            return abort(404);
        }
    }


    /**
     * Delete a Team
     */
    public function deleteTeam($teamid) {
        $team = Team::findOrFail($teamid);
        if (Auth::user()->can('delete', $team)) {
            $team->delete();
            return redirect()->route('dashboard.section', ['section' => 'teams']);
        } else {
            return abort(401);
        }
    }

}
