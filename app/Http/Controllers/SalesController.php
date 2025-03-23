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

    public function add_sales(Request $req)
    {
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = new User();
            $user->name = $req['name'];
            $user->email = $req['email'];
            $user->password = bcrypt($req['password']);
            $user->role = 'sales';
            $user->save();

            return redirect('/sales/manage-sales');
        }

        return view('sales.add_sales');
    }

    public function delete_sales($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/sales/manage-sales');
    }

    public function edit_sales(Request $req, $id)
    {
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = User::find($id);
            $user->name = $req['name'];
            $user->email = $req['email'];
            $user->password = bcrypt($req['password']);
            $user->save();

            return redirect('/sales/manage-sales');
        }

        $user = User::find($id);
        return view('sales.edit_sales', ['user' => $user]);
    }

    

    
}
