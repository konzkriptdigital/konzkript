<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaddleController extends Controller
{
    //
    public function webhook(Request $request)
    {
        logger($request->all());
    }
}
