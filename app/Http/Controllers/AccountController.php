<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function manage_accounts()
    {
        $data['accounts'] = AccountModel::where('user_id', Auth::user()->id)->get();

        return view('accounts.manage_accounts')->with($data);
    }

    public function add_account(Request $req)
    {

        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'account_name' => 'required',
                'phone' => 'required',
            ]);
            // create account
            $account = new AccountModel;
            $account->user_id = Auth::user()->id;
            $account->account_name = $req['account_name'];
            $account->phone = $req['phone'];
            $account->website = $req['website'];
            $account->save();

            return redirect('/accounts/manage-accounts');
        }
        return view('accounts.add_account');
    }

    public function edit_account($id = 0, Request $req)
    {
        $data['account_detail'] = AccountModel::find($id);
        if ($data['account_detail'] == '') {
            return redirect('/accounts/manage-accounts');
        }
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'account_name' => 'required',
                'phone' => 'required',
            ]);
            // create account
            $data['account_detail']->account_name = $req['account_name'];
            $data['account_detail']->phone = $req['phone'];
            $data['account_detail']->website = $req['website'];
            $data['account_detail']->save();

            return redirect('/accounts/manage-accounts');
        }
        return view('accounts.edit_account')->with($data);
    }

    public function delete_account($id = 0)
    {
        $account = AccountModel::find($id);

        $account->delete();
        return redirect('/accounts/manage-accounts');
    }
}


