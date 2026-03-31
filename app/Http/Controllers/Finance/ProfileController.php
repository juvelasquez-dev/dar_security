<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show finance profile.
     */
    public function index(Request $request)
    {
        return view('finance.profile.profile');
    }
}
