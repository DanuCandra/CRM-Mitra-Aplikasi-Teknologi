<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\ContactModel;
use App\Models\DealModel;
use App\Models\ProspectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
{
    public function add_prospect(Request $req)
    {
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'title' => 'required',
                'company' => 'required',
                'phone' => 'required|min:10',
                'email' => 'required',
            ]);

            $prospect = new ProspectModel();
            $prospect->user_id = Auth::user()->id;
            $prospect->first_name = $req['first_name'];
            $prospect->last_name = $req['last_name'];
            $prospect->title = $req['title'];
            $prospect->company = $req['company'];
            $prospect->phone = $req['phone'];
            $prospect->email = $req['email'];
            $prospect->prospect_source = $req['prospect_source'];
            $prospect->prospect_status = $req['prospect_status'];
            $prospect->street = $req['street'];
            $prospect->city = $req['city'];
            $prospect->state = $req['state'];
            $prospect->zip_code = $req['zip_code'];
            $prospect->country = $req['country'];
            $prospect->description = $req['description'];
            $prospect->save();

            return redirect('/prospects/manage-prospects');
        }
        return view('prospects.add_prospect');
    }

    public function manage_prospects()
    {
        $prospects = ProspectModel::where('user_id', Auth::user()->id)->get();
        return view('prospects.manage_prospects', ['prospects' => $prospects]);
    }

    public function delete_prospect($id)
    {
        $prospect = ProspectModel::find($id);
        $prospect->delete();
        return redirect('/prospects/manage-prospects');
    }

    public function edit_prospect(Request $req, $id)
    {
        $prospect = ProspectModel::find($id);
        if (!$prospect) {
            return redirect('/prospects/manage-prospects');
        }

        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'title' => 'required',
                'company' => 'required',
                'phone' => 'required|min:10',
                'email' => 'required',
            ]);

            $prospect->first_name = $req['first_name'];
            $prospect->last_name = $req['last_name'];
            $prospect->title = $req['title'];
            $prospect->company = $req['company'];
            $prospect->phone = $req['phone'];
            $prospect->email = $req['email'];
            $prospect->prospect_source = $req['prospect_source'];
            $prospect->prospect_status = $req['prospect_status'];
            $prospect->street = $req['street'];
            $prospect->city = $req['city'];
            $prospect->state = $req['state'];
            $prospect->zip_code = $req['zip_code'];
            $prospect->country = $req['country'];
            $prospect->description = $req['description'];
            $prospect->save();

            return redirect('/prospects/manage-prospects');
        }
        $data = $prospect;
        return view('prospects.edit_prospect', ['prospect' => $data]);
    }

    public function view_prospect($id)
    {
        $prospect = ProspectModel::find($id);
        if (!$prospect) {
            return redirect('/prospects/manage-prospects');
        }
        return view('prospects.view_prospect', ['prospect' => $prospect]);
    }

    public function convert_prospect($id, Request $req)
    {
        $prospect = ProspectModel::find($id);
        if (!$prospect) {
            return redirect('/prospects/manage-prospects');
        }

        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'deal_name' => 'required',
                'closing_date' => 'required',
                'deal_stage' => 'required',
            ]);

             // create account
             $account = new AccountModel();
             $account->user_id = Auth::user()->id;
             $account->account_name = $prospect->company;
             $account->phone = $prospect->phone;
             $account->save();
 
             $account_id = $account->id;

             // create contact
            $contact = new ContactModel();
            $contact->user_id = Auth::user()->id;
            $contact->contact_name = $prospect->first_name . ' ' . $prospect->last_name;
            $contact->account_id = $account_id;
            $contact->email = $prospect->email;
            $contact->phone = $prospect->phone;
            $contact->save();

            $contact_id = $contact->id;

            // create deal
            $deal = new DealModel();
            $deal->user_id = Auth::user()->id;
            $deal->amount = $req['amount'];
            $deal->deal_name = $req['deal_name'];
            $deal->closing_date = $req['closing_date'];
            $deal->deal_stage = $req['deal_stage'];
            $deal->account_id = $account_id;
            $deal->contact_id = $contact_id;
            $deal->save();

            // delete prospect
            $prospect->delete();

            return redirect('/deals/manage-deals');
        }

        $data = $prospect;
        return view('prospects.convert_prospect', ['prospect' => $data]);
    }
}
