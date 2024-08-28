<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){
        return view('dashboard.dashboard',[
            'title' => 'Dashboard',
            'employeeCount' => Employee::count(),
        ]);
    }
}
