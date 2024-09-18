<?php

namespace App\Http\Controllers;

use App\Services\GhlApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GhlController extends Controller
{
    public function code(Request $request)
    {
        if ($request->has('code') && $request->has('state')) {
            $ghlApi = new GhlApiService(
                $request->code,
                $request->state
            );

            $response = $ghlApi->ghlOauth();

            $message = $response['userType'] === "Location" ?
                'Location added successfully' :
                'Company added successfully';

            if($response['userType'] === "Location") {
                $userId = $ghlApi->getLocation($response);
            }
            else {
                $userId = $ghlApi->getCompany($response);
            }

            if($userId) {
                Auth::loginUsingId($userId);
                return;
                return redirect()->route('dashboard')->with('message', $message);
            }
        }

        return redirect()->route('dashboard')
            ->with('error', 'Something went wrong! Unable to authenticate GHL account!');
    }
}
