<?php

namespace App\Http\Controllers;

use App\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExportImportController extends Controller
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

    public function export() {
        $user = Auth::User();
        $user->load('keys');
        return response(json_encode($user))->withHeaders([
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename=akmey_export.json'
        ]);
    }

    public function import(Request $request) {
        $file = json_decode($request->jsonexport->get());
        $user = Auth::User();
        foreach ($file->keys as $content) {
            $key = new Key;
            $key->key = $content->key;
            $key->comment = $content->comment;
            $key->user()->associate($user);
            $key->save();
        }
        return redirect('dashboard');
    }

}
