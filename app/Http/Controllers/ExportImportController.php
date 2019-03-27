<?php

namespace App\Http\Controllers;

use App\Key;
use Validator;
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
        $file = json_decode($request->jsonexport->get(), true);
        $user = Auth::User();
        $errs = array();
        foreach ($file['keys'] as $content) {
            $validator = Validator::make($file, [
                'key' => 'required|string|unique:keys|regex:/^ssh-(?:[0-9a-z]){2,} [\S]{12,}$/'
            ]);
            if (!$validator->fails()) {
                $key = new Key;
                $key->key = $content['key'];
                $key->comment = $content['comment'];
                $key->user()->associate($user);
                $key->save();
            } else {
                array_push($errs, __('dashboard.settings.importerr', ['name' => $content['comment'], 'err' => $validator->errors()->first()]));
            }
        }
        return redirect('dashboard')->with('status', $errs);
    }

}
