<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\ContactModel;
use App\Models\DealModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function manage_deals()
    {
        $data['deals'] = DealModel::where('user_id', Auth::user()->id)->with('get_account_detail')->get();

        return view('deals.manage_deals')->with($data);
    }

    public function add_deal(Request $req)
    {

        $data['accounts'] = AccountModel::where('user_id', Auth::user()->id)->get();
        $data['contacts'] = ContactModel::where('user_id', Auth::user()->id)->get();

        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'deal_name' => 'required',
                'closing_date' => 'required',
                'deal_stage' => 'required',
                'account_id' => 'required',
                'contact_id' => 'required',
            ]);

            $deal = new DealModel();
            $deal->user_id = Auth::user()->id;
            $deal->account_id = $req['account_id'];
            $deal->contact_id = $req['contact_id'];
            $deal->amount = $req['amount'];
            $deal->deal_name = $req['deal_name'];
            $deal->closing_date = $req['closing_date'];
            $deal->deal_stage = $req['deal_stage'];
            $deal->save();

            return redirect('/deals/manage-deals');
        }
        return view('deals.add_deal')->with($data);
    }

    public function delete_deal($id)
    {
        $deal = DealModel::find($id);
        if ($deal == '') {
            return redirect('/deals/manage-deals');
        }

        $deal->delete();
        return redirect('/deals/manage-deals');
    }

    public function edit_deal($id, Request $req)
    {
        $deal = DealModel::find($id);
        if ($deal == '') {
            return redirect('/deals/manage-deals');
        }
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'deal_name' => 'required',
                'closing_date' => 'required',
                'deal_stage' => 'required',
                'account_id' => 'required',
                'contact_id' => 'required',
            ]);

            $deal->account_id = $req['account_id'];
            $deal->contact_id = $req['contact_id'];
            $deal->amount = $req['amount'];
            $deal->deal_name = $req['deal_name'];
            $deal->closing_date = $req['closing_date'];
            $deal->deal_stage = $req['deal_stage'];
            $deal->save();

            return redirect('/deals/manage-deals');
        }

        $data['deal_detail'] = $deal;
        $data['accounts'] = AccountModel::where('user_id', Auth::user()->id)->get();
        $data['contacts'] = ContactModel::where('user_id', Auth::user()->id)->get();
        return view('deals.edit_deal')->with($data);
    }
}
