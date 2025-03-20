<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function manage_sales()
    {
        $data = User::where('role', 'sales')->get();
        return view('sales.manage_sales', ['sales' => $data]);
    }

    
}
