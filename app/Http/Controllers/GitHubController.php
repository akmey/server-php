<?php

namespace App\Http\Controllers;

use Auth;
use GitHub;
use App\Key;
use Socialite;
use Illuminate\Http\Request;

class GitHubController extends Controller {
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider() {
        return Socialite::driver('github')->scopes(['read:public_key'])->redirect();
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

        $request->session()->flash('gh-keys', $keys);

        return view('github.import', ['keys' => $keys]);
    }

    public function importGitHubKeys(Request $request) {
        if (empty($request->session()->get('gh-keys'))) {
            return abort(419);
        }
        $keys = array();
        foreach ($request->session()->get('gh-keys') as $key) {
            foreach ($request->input() as $index => $value) {
                if ($index == $key['id']) {
                    $keys[] = $key;
                }
            }
        }
        foreach ($keys as $obj) {
            $key = new Key;
            $key->comment = $obj['title'];
            $key->key = $obj['key'];
            $key->user()->associate(Auth::user());
            $key->save();
        }
        return redirect('dashboard');
    }
}
