<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Key;

class APIController extends Controller
{
    public function addKey(Request $request)
    {
        if (empty($request->input('key'))) {
            return response()->json(['error' => 'missing_key', 'message' => 'missing key'], 400);
        } else {
            // if (Auth::user()->can('create', Key::class)) { // FIXME: this will always return false
            if (Auth::user()->can('create', Key::first())) {  // This seems to work better
                $request->validate([
                    'key' => 'string|unique:keys'
                ]);
                $key = new Key;
                $key->key = $request->input('key');
                $key->user()->associate(Auth::User());
                $key->save();
                return response()->json(['success' => true, 'key' => $key], 201);
            } else {
                return response()->json(['error' => 'not_authorized', 'message' => 'You cannot create keys'], 401);
            }
        }
    }

    public function editKey(Request $request, $keyid)
    {
        if (empty($request->input('comment'))) {
            return response()->json(['error' => 'missing_arguments', 'message' => 'You can edit key comment by passing `comment`'], 400);
        } else {
            $key = Key::find($keyid);
            if (empty($key)) {
                return response()->json(['error' => 'not_found', 'message' => 'This key does not exist.'], 404);
            } elseif (Auth::user()->cant('update', $key)) {
                return response()->json(['error' => 'not_authorized', 'message' => 'You cannot edit this key (it\'s not your key)'], 403);
            } else {
                $key->comment = $request->input('comment');
                $key->save();
                return response()->json(['success' => true, 'key' => $key], 200);
            }
        }
    }

    public function deleteKey(Request $request, $keyid)
    {
        $key = Key::find($keyid);
        if (empty($key)) {
            return response()->json(['error' => 'not_found', 'message' => 'This key does not exist.'], 404);
        } elseif (Auth::user()->cant('update', $key)) {
            return response()->json(['error' => 'not_authorized', 'message' => 'You cannot delete this key (it\'s not your key)'], 403);
        } else {
            $key->delete();
            return response()->json(['success' => true], 200);
        }
    }

    public function getKey(Request $request, $keyid)
    {
        $key = Key::find($keyid);
        if (empty($key)) {
            return response()->json(['error' => 'not_found', 'message' => 'This key does not exist.'], 404);
        } else {
            return response()->json($key);
        }
    }

    public function fetchKey(Request $request) {
        $key = Key::where('key', $request->input('key'))->first();
        if (empty($key)) {
            return response()->json(['error' => 'not_found', 'message' => 'This key is not registered on Akmey.'], 404);
        } else {
            return response()->json($key, 200);
        }
    }

    private $filter;

    public function getUser(Request $request, $userid = 'self') {
        if ($userid == 'self') {
            $user = Auth::user();
        } else {
            $user = User::find($userid);
        }
        if (empty($user)) {
            return response()->json(['error' => 'not_found', 'message' => 'This user does not exist.'], 404);
        } else {
            if ($request->input('filter')) {
                $this->filter = $request->input('filter');
                $user->load(['keys' => function ($query) {
                    $query->where('comment', $this->filter);
                }]);
            } else {
                $user->load('keys');
            }
            return response()->json($user, 200);
        }
    }

    public function getUserByQuery(Request $request, $query = 'self') {
        if ($query == 'self') {
            $user = Auth::user();
        } else {
            $user = User::where('email', $query)->orWhere('name', $query)->first();
        }
        if (empty($user)) {
            return response()->json(['error' => 'not_found', 'message' => 'This user does not exist.'], 404);
        } else {
            if ($request->input('filter')) {
                $this->filter = $request->input('filter');
                $user->load(['keys' => function ($query) {
                    $query->where('comment', $this->filter);
                }]);
            } else {
                $user->load('keys');
            }
            return response()->json($user, 200);
        }
    }
}
