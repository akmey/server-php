<?php

namespace App\Http\Controllers;

use App;
use ExportLocalization;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function getJSON() {
        $arr = ExportLocalization::export()->toFlat();
        $arr['defaultlang'] = App::getLocale();
        return response()->json($arr);
    }
}
