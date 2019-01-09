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
            $key = Key::create($request->input('key'),Auth::User());
            if ($key === false) {
                return response()->json(['error' => 'already_registered', 'message' => 'This key is already registered.'], 403);
            } else {
                return response()->json(['success' => true, 'key' => $key], 201);
            }
        }
    }

    public function editKey(Request $request, $keyid)
    {
        if (empty($request->input('comment'))) {
            return response()->json(['error' => 'missing_arguments', 'message' => 'You can edit key comment by passing `comment`'], 400);
        } else {
            $key = Key::getById($keyid);
            if (empty($key)) {
                return response()->json(['error' => 'not_found', 'message' => 'This key does not exist.'], 404);
            } elseif ($key->userid != Auth::id()) {
                return response()->json(['error' => 'not_authorized', 'message' => 'You cannot edit this key (it\'s not your key)'], 403);
            } else {
                $key = Key::edit($keyid, $request->only('comment'));
                return response()->json(['success' => true, 'key' => $key], 200);
            }
        }
    }

    public function deleteKey(Request $request, $keyid)
    {
        $key = Key::getById($keyid);
        if (empty($key)) {
            return response()->json(['error' => 'not_found', 'message' => 'This key does not exist.'], 404);
        } elseif ($key->userid != Auth::id()) {
            return response()->json(['error' => 'not_authorized', 'message' => 'You cannot delete this key (it\'s not your key)'], 403);
        } else {
            Key::delete($keyid);
            return response()->json(['success' => true], 200);
        }
    }

    public function getKey(Request $request, $keyid)
    {
        $key = Key::getById($keyid);
        if (empty($key)) {
            return response()->json(['error' => 'not_found', 'message' => 'This key does not exist.'], 404);
        } else {
            return response()->json($key);
        }
    }

    public function fetchKey(Request $request) {
        $key = Key::fetch($request->input('key'));
        if (empty($key)) {
            return response()->json(['error' => 'not_found', 'message' => 'This key is not registered on Akmey.'], 404);
        } else {
            return response()->json($key, 200);
        }
    }

    public function getUser(Request $request, $userid = 'self') {
        if ($userid == 'self') {
            $user = Auth::User();
        } else {
            $user = User::find($userid);
        }
        if (empty($user)) {
            return response()->json(['error' => 'not_found', 'message' => 'This user does not exist.'], 404);
        } else {
            $keys = Key::getByUser($user);
            return response()->json(['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'keys' => $keys], 200);
        }
    }

    public function getUserByEmail(Request $request, $useremail = 'self') {
        if ($useremail == 'self') {
            $user = Auth::User();
        } else {
            $user = User::where('email', $useremail)->first();
        }
        if (empty($user)) {
            return response()->json(['error' => 'not_found', 'message' => 'This user does not exist.'], 404);
        } else {
            $keys = Key::getByUser($user);
            return response()->json(['id' => $user->id, 'name' => $user->name, 'email' => $user->email, 'keys' => $keys], 200);
        }
    }
}