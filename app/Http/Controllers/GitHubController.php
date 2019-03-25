<?php

namespace App\Http\Controllers;

use Auth;
use GitHub;
use App\Key;
use Socialite;
use Validator;
use Illuminate\Http\Request;

class GitHubController extends Controller {
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider() {
        return Socialite::driver('github')->setScopes(['read:public_key'])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return view
     */
    public function handleProviderCallback(Request $request) {
        $user = Socialite::driver('github')->user();

        $connection = GitHub::getFactory()->make([
            'method' => 'token',
            'token' => $user->token
        ], app('github'));

        $keys = $connection->me()->keys()->all();

        $request->session()->push('gh-keys', $keys);

        return view('github.import', ['keys' => $keys]);
    }

    public function importGitHubKeys(Request $request) {
        $gh = $request->session()->pull('gh-keys')[0];
        if (empty($gh)) {
            return abort(419);
        }
        $keys = array();
        $return = array();
        foreach ($gh as $key) {
            foreach ($request->input() as $index => $value) {
                if ($index == $key['id']) {
                    $keys[] = $key;
                }
            }
        }
        foreach ($keys as $obj) {
            $valid = Validator::make($obj, ['key' => 'string|unique:keys|regex:/^ssh-(?:[0-9a-z]){2,} [\S]{12,}$/']);
            if ($valid->fails()) {
                $return[] = __('dashboard.github.err', ['name' => $obj['title']]);
            } else {
                $key = new Key;
                $key->comment = $obj['title'];
                $key->key = $obj['key'];
                $key->user()->associate(Auth::user());
                $key->save();
            }
        }
        return redirect('dashboard')->with('status', $return);
    }
}
