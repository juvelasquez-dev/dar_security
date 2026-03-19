<?php

namespace App\Http\Controllers\Arbos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the ARBO profile page.
     */
    public function index()
    {
        return view('arbos.profile.profile');
    }
}
