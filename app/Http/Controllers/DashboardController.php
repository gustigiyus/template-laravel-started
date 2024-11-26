<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cutting;
use App\Models\Delivery;
use App\Models\EmbroIn;
use App\Models\EmbroOut;
use App\Models\Order;
use App\Models\SewingIn;
use App\Models\SewingOut;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $datas = [
            'headerTitle' => 'Dashboard',
            'pageTitle' => 'Dashboard',
        ];

        return view('pages.dashboard', $datas);
    }
}
