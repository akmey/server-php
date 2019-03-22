<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index() {
        return view('doc');
    }

    public function welcome() {
        return view('welcome');
    }

    public function privacy(Request $request) {
        if ($request->input('register')) {
            return view('privacy', ['register' => true]);
        } else {
            return view('privacy', ['register' => false]);
        }
    }
}
