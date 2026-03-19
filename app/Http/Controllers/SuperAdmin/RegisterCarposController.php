<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class RegisterCarposController extends Controller
{
    public function create()
    {
        return view('super_admin.register_user.enrollCarpos');
    }

    public function manage($branch)
    {
        return view('super_admin.register_user.manageCarpos', compact('branch'));
    }
}