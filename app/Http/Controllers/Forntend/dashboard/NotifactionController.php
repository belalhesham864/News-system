<?php

namespace App\Http\Controllers\Forntend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotifactionController extends Controller
{
    public function index(){
        return view('forntend.dashboard.notifaction');
    }
}
