<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agency;
use App\Models\Agencylog;

class IndexController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if(isset($user->type) && $user->type == 'ADMIN'){
            $agencies = Agency::where('approved', 0)->orderBy('name', 'asc')->get();
            $agencyLogs = Agencylog::where('approved', 0)->orderBy('name', 'asc')->get();

            return view('admin.index', compact('agencies', 'agencyLogs', 'user'));
        }
        else{
            return redirect('/user/login');
        }
    }
}
